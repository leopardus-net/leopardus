<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Languaje;
use App\Setting;

use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        // Obtenemos los lenguajes.
        $languajes = Languaje::all();

        // Le pasamos las variables a la vista
        view()->share(compact('languajes'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'lang' => 'required|string'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
    	// User
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'lang' => $data['lang']
        ]);

        // Profile
        $profile = Profile::create([
        	'user_id' => $user->id
        ]);

        // Roles
        $settings = Setting::first();

        $rol = Role::find($settings->rol_default);
        $rol->user_count += 1;
        $rol->save();

        $user->assignRole($rol->name);
        
        return $user;
    }

    protected function registered(Request $request, $user)
    {
       if( $user->roles->first() ) {

            $path = $user->roles->first()->route;

            return redirect()->intended($path ? $path : $this->redirectTo);
        }
    }
}
