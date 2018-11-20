<?php
namespace Modules\Install\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Setting;
Use App\User;

class InstallController extends Controller
{
    /**
     * Instalador del sistema.
     * @return View
     */
    public function index(Request $request)
    {
        $lang = session('lang') ? session('lang') : 'es';

        if( $request->has('lang') ){
            $lang = $request->input('lang');
            session(['lang_changed' => 1]);
            session(['lang' => $lang]);
        }

        \App::setLocale( $lang );

        // Borramos el cache
		Artisan::call('cache:clear');
        
        $step = $request->input('step', 1);
		// Comprobamos si ya se configuro el .env
        if( sys_configured() && $step < 2 ) {
            return redirect('install?step=2');
        }
        
        //
        return view('install::index', compact('step', 'lang'));
    }

    /**
     * Procesa la información enviada a través de los formularios
     * al instalar el sistema.
     * @return Redirect
     */
    public function processing(Request $request)
    {
        switch ($request->step) {
            case '1':
                try {
                    // Creamos las reglas de validación
                    $validator = \Validator::make($request->all(), [
                        'host' => 'required',
                        'user' => 'required',
                        'pass' => '',
                        'bd' =>   'required',
                        'lang' => 'required'
                    ]);

                    if ($validator->fails()) {
                        return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput();
                    }

                    // Comprobar conexion a la base de datos
                    // si los datos no son correctos enviar mensaje de error.
                    $connection = @mysqli_connect(
                        $request->input('host'),
                        $request->input('user'),
                        $request->input('pass'),
                        $request->input('bd')
                    );

                    if (!$connection) {
                        return redirect()
                                ->back()
                                ->withErrors([
                                    'Imposible conectar a la base de datos. Error: ' . mysqli_connect_error()
                                ])
                                ->withInput();
                    }

                    /* Cierra la conexión */
                    mysqli_close($connection);

                    // Establecemos el tiempo de respuesta maximo a 5min.
                    set_time_limit(3000);

                    // Cambimos el .env
                    $env = new DotenvEditor();
                    $env->changeEnv([
                       'DB_DATABASE'   => $request->input('bd'),
                       'DB_USERNAME'   => $request->input('user'),
                       'DB_PASSWORD'   => $request->input('pass'),
                       'DB_HOST'       => $request->input('host'),
                       'APP_LANG'      => $request->input('lang')
                    ]);

                    return redirect('install?step=2');

                } catch (Exception $e) {
                    return redirect()->back()->withErrors([$e])->withInput();
                }
                break;
            case '2':
                try {
                    // Validamos los campos.
                    $validator = \Validator::make($request->all(), [
                        'title' => 'required|string|max:255',
                        'slogan' => 'required|string|max:255',
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255',
                        'password' => 'required|string|min:6|confirmed',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    // Establecemos el tiempo de respuesta maximo a 5min.
                    set_time_limit(3000);

                    // Creamos el storage link
                    Artisan::call('storage:link');

                    // Ejecutamos las migraciones
                    Artisan::call('migrate', ['--seed' => true]);   

                    $env = new DotenvEditor();

                    // Cambimos el .env
                    $env->changeEnv([
                       'APP_URL'   => $request->input('url')
                    ]);   
                    
                    // Creamos el usuario administrador
                    $admin = new User;
                    $admin->name = $request->input('name');
                    $admin->email = $request->input('email');
                    $admin->password = Hash::make($request->input('password'));
                    $admin->lang = app()->getLocale() === 'es' ? 1 : 2;
                    $admin->save();

                    $rol = Role::find(1);
                    // Agregamos el rango
                    $admin->assignRole($rol->name);
                    //
                    $rol->user_count += 1;
                    $rol->save();

                    // Creamos la configuración
                    $settings = new Setting;
                    $settings->lang = app()->getLocale() === 'es' ? 1 : 2;
                    $settings->name = $request->input('title');
                    $settings->slogan = $request->input('slogan');
                    $settings->site_email = $request->input('email');
                    $settings->description = $request->input('description');
                    $settings->rol_default = $rol->id;
                    $settings->save();

                    // Creamos la tab "información" en el perfil 
                    profile()->makeTab([
                        'name' => [
                            'es' => 'Información basica',
                            'en' => 'Basic Information',
                            'pt' => 'Informação básica'
                        ],
                        'url' => '/profile/information-tab'
                    ]);

                    // Creamos la tab "información" en la configuración del perfil 
                    profile()->settings()->makeTab([
                        'name' => [
                            'es' => 'Información basica',
                            'en' => 'Basic Information',
                            'pt' => 'Informação básica'
                        ],
                        'url' => '/profile/settings/information-tab'
                    ]);

                    profile()->settings()->makeTab([
                        'name' => [
                            'es' => 'Seguridad',
                            'en' => 'Security',
                            'pt' => 'Segurança'
                        ],
                        'url' => '/profile/settings/security-tab'
                    ]);

                    // Autenticamos al usuario
                    Auth::login($admin);

                    // Cache
                    Cache::rememberForever('systemInstalled', function(){
                        return true;
                    });

                    // Redirigimos al usuario
                    return redirect('/admin');

                } catch (Exception $e) {
                    return redirect()->back()->withErrors([$e])->withInput();
                }
                break;
            default:
                return redirect()->back();
                break;
        }
    }
}
