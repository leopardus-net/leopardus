<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;


class RolesController extends Controller
{
    public function index()
    {
        $roles = roles()->all();

        return view('admin.roles.index', compact('roles'));
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
        Role::destroy($id);

        return redirect()
                ->route('roles.index')
                ->with('action', delete);
    }
}
