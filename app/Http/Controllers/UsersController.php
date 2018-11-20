<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;
use App\Profile;

class UsersController extends Controller
{
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
}
