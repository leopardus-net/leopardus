<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

use App\Setting;
use App\languaje;

class SettingsController extends Controller
{
    //
    public function index()
    {
    	// Obtenemos las configuraciones
    	$settings = Setting::first();

        // Obtenemos todos los roles.
    	$roles = Role::all();

    	// Retornamos la vista
    	return view('admin.settings.basic.index', compact('settings', 'roles'));
    }

    public function store(Request $request)
    {
    	try {

            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'slogan' => 'required',
                'site_email' => 'required',
                'maintenance' => 'required',
                'new_users' => 'required',
                'role' => 'required',
                'languaje' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()
                            ->route('admin.settings')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Obtenemos la configuración del sistema.
            $settings = Setting::first();

            if( $request->hasFile('logo_text') ) {
                $file = $request->file('logo_text');
                // Verfirificamos que cumpla con los tamaños correctos.
                $img_propiety = getimagesize($file);
                $width = $img_propiety[0];
                $height = $img_propiety[1];

                //Creamos una instancia de la libreria instalada   
                $image = \Image::make($file);
                //Ruta donde queremos guardar las imagenes
                $path_storage = storage_path('app/public/');

                if( !file_exists($path_storage) ) {
                    \Storage::disk('public')->makeDirectory($path);
                }

                if( $width < 148 && $height < 19 ) {
                    return redirect()->back()
                            ->with('error', 'El logotipo debe ser mayor a 148x19 pixeles.');
                } elseif ( $width > 148 && $height > 19 ) {
                    // Cambiar de tamaño
                    $image->resize(148, 19);
                }
                
                // Guardar
                $image->save( $path_storage.$file->getClientOriginalName() );

                // Guardamos en la base de datos
                $settings->logo_text = '/storage/' . $file->getClientOriginalName();
            }

            if( $request->hasFile('logo_icon') ) {
                $file = $request->file('logo_icon');
                // Verfirificamos que cumpla con los tamaños correctos.
                $img_propiety = getimagesize($file);
                $width = $img_propiety[0];
                $height = $img_propiety[1];

                //Creamos una instancia de la libreria instalada   
                $icon = \Image::make($file);
                //Ruta donde queremos guardar las imagenes

                $path_storage = storage_path('app/public/');

                if( !file_exists($path_storage) ) {
                    \Storage::disk('public')->makeDirectory($path);
                }

                if( $width < 32 && $height < 32 ) {
                    return redirect()->back()
                            ->with('error', 'El logotipo debe ser mayor a 32x32 pixeles.');
                } elseif ( $width > 68 && $height > 68 ) {
                    // Cambiar de tamaño
                    $icon->resize(68, 68);
                }

                // Guardar
                $icon->save( $path_storage . $file->getClientOriginalName() );

                // Guardamos en la base de datos
                $settings->logo_icon = '/storage/' . $file->getClientOriginalName();

                /***********************************
                --------Creamos el favicon----------
                ***********************************/
                $favicon_path = $path_storage.'/favicon';
                // Redimencionamos
                $icon->resize(64, 64);
                $icon->save( $favicon_path . '-64.png');

                $icon->resize(32, 32);
                $icon->save( $favicon_path . '-32.png');

                $icon->resize(16, 16);
                $icon->save( $favicon_path . '-16.png');
                //
                $settings->favicon = '/storage/favicon';
            }

            // Actualizamos la data.
            $settings->name = $request->name;
            $settings->slogan = $request->slogan;
            $settings->category_type = $request->category_type;
            $settings->company_name = $request->company_name;
            $settings->company_email = $request->company_email;
            $settings->site_email = $request->site_email;
            $settings->description = $request->description;
            $settings->enable_register = $request->new_users;
            $settings->maintenance = $request->maintenance;
            $settings->rol_default = $request->role;
            $settings->lang = $request->languaje;
            $settings->save();

            try{
                // Obtenemos el lenguaje
                $lang = Languaje::find($request->languaje);
                // .ENV
                $env = new DotenvEditor();
                // Cambiamos el .env
                $env->changeEnv([
                   'APP_LANG'	=> $lang->iso ? $lang->iso : 'es'
                ]);
            } catch(DotEnvException $e) {
                echo $e->getMessage();
            }

            // redirect
            return redirect()->route('admin.settings')->with('action', 'update'); 
        } catch (Exception $e) {
            return redirect()
                    ->route('admin.settings')
                    ->with('error', $e)
                    ->withInput();
        }
    }
}
