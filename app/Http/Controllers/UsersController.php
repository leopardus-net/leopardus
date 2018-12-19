<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;
use App\Profile;
use App\ProfileTab;

class UsersController extends Controller
{

    public function __construct()
    {
        // Pagina para el menú
        $page = route('admin.users.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }

    //
    public function index(Request $request)
    {
    	// Obtenemos todos los roles
    	$roles =  Role::all();

    	if( $request->role ) {
    		$users =  User::role($request->role)->paginate(20);
    	} else {
    		$users =  User::paginate(20);
    	}

    	$user_all_count = User::count();

    	return view('admin.users.index', compact('users', 'roles', 'user_all_count'));
    }

    public function getUserDetails(Request $request, $id)
    {
        $user = User::findOrFail($id);
    	$tabs = ProfileTab::where('type', 'profile')->get();

    	// Obtenemos la tabla por defecto.
    	$tabSelected = function() use ($request, $tabs){
    		//
    		if($request->has('tab')) {
    			$tab = ProfileTab::where('slug', str_slug($request->tab))->where('type', 'profile')->first();

    			if(!$tab) {
    				return $tabs->count() ? $tabs->first() : false;
    			}

    			return $tab;
    		} else {
    			//
    			return $tabs->count() ? $tabs->first() : false;
    		}
    	};

    	return view('admin.users.profile.index', compact('user', 'tabs', 'tabSelected'));
    }

    public function getUserSettings(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $profile = $user->profile;

        $tabs = ProfileTab::where('type', 'settings')->get();

        // Obtenemos la tabla por defecto.
        $tabSelected = function() use ($request, $tabs){
            //
            if($request->has('tab')) {
                $tab = ProfileTab::where('slug', str_slug($request->tab))->where('type', 'settings')->first();

                if(!$tab) {
                    return $tabs->count() ? $tabs->first() : false;
                }

                return $tab;
            } else {
                //
                return $tabs->count() ? $tabs->first() : false;
            }
        };

        return view('admin.users.profile.settings.index', compact('user', 'profile', 'tabs', 'tabSelected'));
    }

    public function userInformationTab(Request $request, $id)
    {
    	$user = User::findOrFail($id);
    	$profile = $user->profile;
    	
    	return view('profile.tab-information', compact('user','profile'));
    }

    public function store(Request $request)
    {
        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users|max:255',
            'password' => 'required|string|min:6|max:255',
            'lang' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	// Creamos el usuario.
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = \Hash::make($request->password);
    	$user->lang = $request->lang;
    	$user->save();

        // Creamos el perfil
        $profile = Profile::firstOrCreate([
            'user_id' => $user->id
        ]);

    	// Le asignamos el role.
        $this->attach_new_role($request->role, $user);

        // 
        return redirect()->back()->with('action', 'created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::find($id);
        $profile = $user->profile;
        $roles = $user->roles;

        if (!empty($roles)) {
            foreach ($roles as $role) {
              $user->removeRole($role->id);
            }
        }

        if($profile) {
        	$profile->delete();
        }

        $user->delete();   
     
        return redirect('/admin/users')
        		->with('action', 'deleted');
    }

    public function changeRole(Request $request)
    {
    	// Obtenemos el usuario.
    	$user = User::find($request->user_id);

    	if( $user ) {
    		if( $user->roles->first() ) {
    			// Obtenemos el old role.
    			$this->remove_current_role($user);
		        // Establecemos el nuevo rol.
		        $this->attach_new_role($request->role, $user);
			} else {
				// Establecemos el nuevo rol.
		        $this->attach_new_role($request->role, $user);
			}
    	}

        return redirect()->back()->with('action', 'role_changed');
    }

    private function attach_new_role($role, $user)
    {
    	// Obtenemos el nuevo role.
        $new = Role::find( $role );
        $new->user_count += 1;
        $new->save();
        // Asignamos el nuevo rol
		$user->assignRole($new->name);
    }

    private function remove_current_role($user)
    {
    	$old = $user->roles->first();
		$old->user_count -= 1;
		$old->save();

    	// Removemos el rol del usuario. 
        $user->removeRole($old->name);
    }

    public function uploadProfileImage(Request $request, $id)
    {
        // Validaciones.
        $validator = \Validator::make($request->all(), [
            'avatar' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors());
        }

        // Obtenemos el usuario.
        $user = User::findOrFail($id);
        
        // Obtenemos el archivo.
        $file = $request->file('avatar');

        // Verfirificamos que cumpla con los tamaños correctos.
        $img_propiety = getimagesize($file);
        $width = $img_propiety[0];
        $height = $img_propiety[1];

        //Ruta donde queremos guardar las imagenes
        $path_storage = storage_path('app/public/avatars/' . $user->id);

        if( !file_exists($path_storage) ) {
            \Storage::disk('public')->makeDirectory('avatars/' . $user->id, '0775');
        }

        if( $width < 250 && $height < 250 ) {
            // traducir
            return response()->json(['error' => 'El avatar debe ser mayor o igual a 250x250 pixeles.']);
        }

        //Creamos una instancia de la libreria instalada   
        $image = \Image::make($file);
        $timestamp = time();

        // Guardar
        $image->save( $path_storage . '/' . $user->id . $timestamp . '.jpg' );
        
        // Guardar 250x250
        if ( $width > 250 && $height > 250 ) {
            $img_250 = $image;
            $img_250->resize(250, 250);
            $img_250->save( $path_storage . '/' . $user->id . $timestamp . '_250.jpg' );
        }

        // Guardar 120x120
        $img_120 = $image;
        $img_120->resize(160, 160);
        $img_120->save( $path_storage . '/' . $user->id . $timestamp . '_160.jpg' );

        // Guardar 60x60
        $img_60 = $image;
        $img_60->resize(60, 60);
        $img_60->save( $path_storage . '/' . $user->id . $timestamp . '_60.jpg' );

        // Guardamos en la base de datos
        $route = '/storage/avatars/' . $user->id . '/' . $user->id . $timestamp;
        $user->avatar = $route;
        $user->save();

        return response()->json([
            'error' => false,
            'image' => url($route . '_250.jpg')
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validaciones.
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'birthday' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                     ->withErrors($validator->errors());
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        $profile = Profile::firstOrCreate([
            'user_id' => $user->id
        ]);

        $profile->biography = $request->biography;
        $profile->phone = $request->phone;
        $profile->birthday = $request->birthday;
        $profile->country = $request->country;
        $profile->province = $request->province;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->postal_code = $request->postal_code;
        $profile->save();

        return redirect()->route('admin.user-details', $user->id)
                ->with('action', 'updated');
    }

    public function updatePassword(Request $request, $id)
    {
        // Validaciones.
        $validator = \Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
           return redirect()->back()
                    ->withErrors($validator->errors());
        }

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('admin.user-details', $user->id)
                ->with('action', 'updated-pass');
    }

    public function settingsInformationTab(Request $request, $id) {
        $user = User::findOrFail($id);
    	$profile = $user->profile;
    	
    	return view('admin.users.profile.settings.tab-information', compact('user','profile'));
    }

    public function settingsSecurityTab(Request $request, $id) {
        $user = User::findOrFail($id);
    	$profile = $user->profile;
    	
    	return view('admin.users.profile.settings.tab-security', compact('user','profile'));
    }
}
