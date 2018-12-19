<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\ProfileTab;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Pagina para el menú
        $page = route('profile');

        // Compartimos la variable
        view()->share(compact('page'));
    }

    //
    public function index(Request $request)
    {
    	$user = auth()->user();
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

    	return view('profile.index', compact('user', 'tabs', 'tabSelected'));
    }

    public function informationTab()
    {
    	$user = auth()->user();
    	$profile = $user->profile;
    	
    	return view('profile.tab-information', compact('user','profile'));
    }

    public function settings(Request $request)
    {
        $user = auth()->user();
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

        return view('profile.settings.index', compact('user', 'profile', 'tabs', 'tabSelected'));
    }

    public function uploadProfileImage(Request $request)
    {
        // Validaciones.
        $validator = \Validator::make($request->all(), [
            'avatar' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors());
        }

        // Obtenemos el usuario.
        $user = auth()->user();
        
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

    public function update(Request $request)
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

        $user = auth()->user();
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

        return redirect()->route('profile')->with('action', 'updated');
    }

    public function updatePassword(Request $request)
    {
        // Validaciones.
        $validator = \Validator::make($request->all(), [
            'old' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
           return redirect()->back()
                    ->withErrors($validator->errors());
        }

        $user = auth()->user();

        # comprobamos que sea el password anterior
        if (\Auth::attempt(['email' => $user->email, 'password' => $request->old])) {
            // 
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('profile')
                    ->with('action', 'updated-pass');
                    
        } else {
            return redirect()->back()
                    ->with('error', 'account.security.errors.password-fail');
        }     

    }

    public function settingsInformationTab(Request $request) {
        $user = auth()->user();
    	$profile = $user->profile;
    	
    	return view('profile.settings.tab-information', compact('user','profile'));
    }

    public function settingsSecurityTab(Request $request) {
        $user = auth()->user();
    	$profile = $user->profile;
    	
    	return view('profile.settings.tab-security', compact('user','profile'));
    }
}
