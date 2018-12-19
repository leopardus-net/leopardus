<?php

namespace App\Kernel\Helpers;

use Spatie\Permission\Models\Role;

use App\Permission;
use App\PermissionGroup;

class Permissions 
{
    const WEB_MASTER_ROLE_ID = 1;

    protected $role;
    protected $group;
	protected $permission;
    protected $translations;
    protected $guard;

	public function __construct()
    {
        $this->guard = config('auth.defaults.guard');

        $this->translations = translations('permissions-list');
    }

    public function get($permission = null)
    {
        if(!is_null($permission)) {
            if( is_string($permission) ) {
                // Obtenemos el permiso por el nombre.
                $this->permission = Permission::where('name', str_slug($permission, '-'))->firstOrFail();
            } elseif( is_integer($permission) ) {
                // Obtenemos el permiso por el ID.
                $this->permission = Permission::findOrFail($permission);
            } else {
                return "Error: the parameter is not of type integer or string";
            }
        }
    }

    public function role(Role $role)
    {
        $this->role = $role;

        return $this;
    }

    protected function slug_generator(Array $data): String
    {
        $slug = ($this->group) ? $this->group->slug.'.' : '';

        if(is_string($data['name'])) {
            // 
            if( array_key_exists('slug', $data) && $data['slug'] ) {
	        	$slug = $data['slug'];
	    	} else {
            	$slug .= str_slug($data['name'], '-'); 
	    	}

            // Obtenemos los lenguajes instalados.
            foreach ( $this->translations->getLocales() as $locale) {
                // Creamos una nueva traducción
                $this->translations->add($slug, $data['name'], $locale);
            }
        }
        
        if(is_array($data['name'])) {
            //
            $arrays = collect($data['name']);

            if( array_key_exists('slug', $data) && !empty($data['slug']) ) {
	        	$slug .= $data['slug'];
	    	} else { 
            	$slug .= str_slug($arrays->first(), '-');
	    	}

            // recorremos los nombres.
            foreach ($arrays as $locale => $value) {
                $this->translations->add($slug, $value, $locale);
            }
        }

        return $slug ? $slug : false;
    }

    public function group(Int $group)
    {
        $permission = PermissionGroup::find($group);

        $this->group = $permission;

        return $this;
    }

    public function addGroup($data, String $slug = null)
    {
        $translations = \translations('permissions-group-list');

        if(is_string($data)) {
            // 
            if( \is_null($slug) ) {
            	$slug = str_slug($data, '-'); 
	    	}

            // Obtenemos los lenguajes instalados.
            foreach ( $this->translations->getLocales() as $locale) {
                // Creamos una nueva traducción
                $translations->add($slug, $data, $locale);
            }
        }elseif(is_array($data)) {
            //
            $arrays = collect($data);

            if( \is_null($slug) ) {
            	$slug = str_slug($arrays->first(), '-');
	    	}

            foreach ($arrays as $locale => $value) {
                $translations->add($slug, $value, $locale);
            }
        }

        $this->group = PermissionGroup::firstOrCreate([
            'slug' => $slug
        ]);

        $translations->publish();

        return $this;
    }

    public function create(Array $data)
    {
        // slug
        $slug = $this->slug_generator($data);

        // make permission
        $this->permission = Permission::firstOrCreate([
            'name' => $slug,
            'group' => $this->group->id
        ]);

        // attach permission to role
        $master_role = Role::find(self::WEB_MASTER_ROLE_ID);
        $master_role->givePermissionTo($this->permission);

        if($this->role):
            $role = $this->role;
            $role->givePermissionTo($this->permission);
        endif;

        // Exportamos la traducciín a la carpeta lang
        $this->translations->publish();

        return $this;
    }

    public function update(Array $data)
    {
        // slug
        $slug = $this->slug_generator($data);

        // make permission
        $this->permission = Permission::firstOrCreate([
            'name' => $slug,
            'group' => $this->group->id
        ]);

        // Exportamos la traducciín a la carpeta lang
        $this->translations->publish();

        return $this->permission;
        
    }

    public function make(Array $array)
    {
        foreach($array as $data) {
            $this->create($data);
        }

        return $this;
    }

}
