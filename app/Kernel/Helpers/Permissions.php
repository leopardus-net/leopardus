<?php

namespace App\Kernel\Helpers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions 
{
	const SUPER_ADMIN_ROLE_ID = 1;
	const WEB_MASTER_ROLE_ID = 2;

	protected $permission;

    protected $translations;

	public function __construct()
    {
        $this->translations = translations('permissions-list');
    }

    public function get($permission = null)
    {
        if(!is_null($permission)) {
            if( is_string($permission) ) {
                // Obtenemos el rol por el nombre.
                $this->permission = Permission::where('name', str_slug($permission, '-'))->firstOrFail();
            } elseif( is_integer($permission) ) {
                // Obtenemos el rol por el ID.
                $this->permission = Permission::findOrFail($permission);
            } else {
                return "Error: the parameter is not of type integer or string";
            }
        }
    }

    public function add($data)
    {
        if( !is_array( $data['name'] ) ) {
            // 
            if( array_key_exists('slug', $data) && !empty($data['slug']) ) {
	        	$slug = $data['slug'];
	    	} else {
            	$slug = str_slug($data['name'], '-'); 
	    	}

            // Obtenemos los lenguajes instalados.
            foreach ( $this->translations->getLocales() as $locale) {
                // Creamos una nueva traducción
                $this->translations->add($slug, $data['name'], $locale);
            }
        } elseif(is_string($data['name'])) {
            //
            $arrays = collect($data['name']);

            if( array_key_exists('slug', $data) && !empty($data['slug']) ) {
	        	$slug = $data['slug'];
	    	} else { 
            	$slug = str_slug($arrays->first(), '-');
	    	}

            // recorremos los nombres.
            foreach ($arrays as $locale => $value) {
                $this->translations->add($slug, $value, $locale);
            }
        } else {
            return "Error: the parameter :name: is not of type array or string";
        }

        // Creamos el permiso
        $this->permission = Permission::create([
            'name' => $slug
        ]);

        // Asignamos el permiso a los principales roles.
        $super_admin_role = Role::find(self::SUPER_ADMIN_ROLE_ID);
        $super_admin_role->givePermissionTo($this->permission);
        //
        $master_role = Role::find(self::WEB_MASTER_ROLE_ID);
        $master_role->givePermissionTo($this->permission);

        // Exportamos la traducciín a la carpeta lang
        $this->translations->publish();

        return $this->permission;
    }

}
