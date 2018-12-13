<?php

namespace App\Kernel\Helpers;

use Spatie\Permission\Models\Role;

class Roles 
{
    protected $role;

    protected $translations;

	public function __construct()
    {
        $this->translations = translations('roles-list');
    }

    public function all()
    {
        return Role::all();
    }

    public function get($role = null)
    {
        if(!is_null($role)) {
            if( is_string($role) ) {
                // Obtenemos el rol por el nombre.
                $this->role = Role::where('name', str_slug($role, '-'))->firstOrFail();
            } elseif( is_integer($role) ) {
                // Obtenemos el rol por el ID.
                $this->role = Role::findOrFail($role);
            } else {
                return "Error: the parameter is not of type integer or string";
            }
        }
    }


    public function create($data)
    {
        if( is_string( $data['name'] ) ) {
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
        } elseif(is_array($data['name'])) {
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

        // Creamos el role 
        $this->role = Role::firstOrCreate([
            'name' => $slug
        ]);
        
        if( array_key_exists('route', $data) && !empty($data['route']) ) {
            $this->role->route = $data['route'];
        } else {
            $this->role->route = '/';
        }

        $this->role->save();

        // Exportamos la traducciín a la carpeta LANG
        $this->translations->publish();

        return $this->role;
    }

}
