<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


use Spatie\Permission\Models\Role;


class RolesController extends Controller
{
    public function __construct()
    {
        // Pagina para el menú
        $page = route('roles.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }

    public function index()
    {
        $roles = roles()->all();

        return view('admin.roles.index', compact('roles'));
    }

    public function modify(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        return view ('admin.roles.update', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        # validaciones.
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique((new \App\Role)->getTable(), 'name')
                    ->ignore($role->name, 'name')
                    ->ignore($role->id)
            ],
            'route' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('roles.modify', $role->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        # store
        $role = roles($role)->update([
            'name' => $request->name, 
            'slug' => $request->slug, 
            'route' => $request->route
        ]);

        # return
        return redirect()->route('roles.index')->with('action', 'updated');
    }
    
    public function store(Request $request, $id = null)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:roles,name',
            'route' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('permissions.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        $role = roles()->create([
            'name' => $request->name, 
            'slug' => $request->slug, 
            'route' => $request->route
        ]);

        if(is_null($id))
            $action = 'created';
        else {
            $action = 'updated';
        }

        return redirect()->route('roles.index')->with('action', $action);
    }

    public function destroy(Request $request, $id)
    {
        if($id > 2) {
            Role::destroy($id);
            
            return redirect()
                    ->route('roles.index')
                    ->with('action', 'delete');
        } 

        return redirct()->route('roles.index');
    }
}
