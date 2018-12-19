<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Spatie\Permission\Models\Role;

use App\Permission;
use App\PermissionGroup;

class PermissionsController extends Controller
{
    public function __construct()
    {
        // Pagina para el menú
        $page = route('permissions.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }


    public function index()
    {
        $permissions = PermissionGroup::with('permissions')->get();
  
    	return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        # validaciones.
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique((new \App\Permission)->getTable(), 'name')
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('permissions.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        # store
        permissions()
            ->group($request->group)
            ->create(['name' => $request->name, 'slug' => $request->slug]);

        # return
        return redirect()->back()->with('action', 'created');
    }

    public function modify(Request $request, $id)
    {
        $groups = PermissionGroup::with('permissions')->get();
        $permission = Permission::findOrFail($id);

        # return.
    	return view('admin.permissions.update', compact('groups', 'permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        # validaciones.
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique((new \App\Permission)->getTable(), 'name')
                    ->ignore($permission->name, 'name')
                    ->ignore($permission->id)
            ],
            'group' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('permissions.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        # store
        permissions($permission->id)
            ->group($request->group)
            ->update([
                'name' => $request->name, 
                'slug' => $request->slug
            ]);

        # return
        return redirect()->route('permissions.index')->with('action', 'updated');
    }

    public function destroy(Request $request, $id)
    {
        # get
        $permission = Permission::find($id);
        # delete
        $permission->delete();
        # return
        return redirect()->back()->with('action', 'deleted');
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
