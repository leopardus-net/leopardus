<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Manegador de idiomas.
use Barryvdh\TranslationManager\Models\Translation;
use Barryvdh\TranslationManager\Manager;

class PermissionsController extends Controller
{
	// Manejador de idiomas.
    protected $lang_manager;

    public function __construct(Manager $lang_manager)
    {
        // Manejador de idiomas.
        $this->lang_manager = $lang_manager;
    }

    public function index()
    {
        $role = Role::first();
        $roles = Role::all();
        $permission = Permission::all();
        $data = $this->parsePermissions($permission, $role);

        // Pasamos las variables a la vista.
        view()->share(compact('roles', 'permission', 'data', 'role'));

        // 
    	return view('admin.permissions.index');
    }

    public function getRole(Request $request, $id)
    {
        $role = Role::find( $id );
        
        if(! $role) {
            return redirect('admin/permissions');
        }

        $roles = Role::all();
        $permission = Permission::all();
        $data = $this->parsePermissions($permission, $role);

        // Pasamos las variables a la vista.
        view()->share(compact('roles', 'permission', 'data', 'role'));

        // 
        return view('admin.permissions.index');
    }

    public function update(Request $request, $id)
    {
    	if( $id > 1 ) {
	        $role = Role::find( $id );
	        $roles = Role::all();
	        $permission = Permission::all();
	        $data = $this->parsePermissions($permission, $role);

	        $update = true;

	        // Pasamos las variables a la vista.
	        view()->share(compact('roles', 'permission', 'data', 'role', 'update'));

	        // 
	        return view('admin.permissions.index');
    	} else {
    		return redirect()->back();
    	}
    }

    public function store(Request $request, $id = null)
    {
        if( is_null($id) ) {
        	// Creamos el role
            $role = Role::create([
            	'name' => str_slug($request->name, '-')
            ]);

            // Creamos una nueva traducción para el role
            $translation = new Translation;
            $translation->locale = 'es';
            $translation->group = 'roles-list';
            $translation->key = str_slug($request->name, '-');
            $translation->value = $request->name;
            $translation->status = Translation::STATUS_SAVED;
            $translation->save();
        } else {
        	// Obtenemos el role
            $role = Role::find($id);

             // Obtenemos la traducción
            $translation = Translation::firstOrNew([
                'locale' => session('lang') ?: 'es',
                'group' => 'roles-list',
                'key' => $role->name,
            ]);

            // Cambiamos la traducción.
            $translation->value = (string) $request->name;
            $translation->status = Translation::STATUS_CHANGED;
            $translation->save();
        }

        // Exportamos nuevamente los archivos a la carpeta LANG
        $this->lang_manager->exportTranslations('roles-list', false);

        return redirect("admin/permissions/role/$role->id");
    }

    public function destroy(Request $request, $id)
    {
        Role::destroy($id);

        return redirect("admin/permissions")
                ->with('message', trans('roles.message_delete'));
    }

    public function togglePermissionToRole(Request $request)
    {
        // Obtenemos el rol y el permiso.
        $role = Role::find($request->role);
        $permission = Permission::find($request->permission);

        if( $role && $permission ) {
            if( $role->hasPermissionTo($permission->name) ) {
                $role->revokePermissionTo($permission);

                return response()->json(['success'=>"roles.revoke-permission"]);
            } else {
                $role->givePermissionTo($permission);

                return response()->json(['success'=>"roles.add-permission"]);
            }
        } else {
            return response()->json(['error'=>"roles.error_role_permission_not_found"]);
        }
    }

    public function parsePermissions($permission, $role)
    {
        $data = collect([]);

        foreach ( $permission as $perm ) {
            //
            $perm_role = DB::table('role_has_permissions')
                ->where('permission_id', '=', $perm->id)
                ->where('role_id', '=', $role->id)
                ->count();

            if( $perm_role > 0 ) {
                //
                $perm['checked'] = true;
            }
            //
            $data->push($perm);
        }

        return $data;
    }
}
