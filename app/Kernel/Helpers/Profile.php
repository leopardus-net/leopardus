<?php

namespace App\Kernel\Helpers;

use App\ProfileTab;
use App\ProfileHeaderItem;

class Profile 
{
    protected $translations;
    protected $type = 'profile'; // profile, settings, header.

	public function __construct()
    {
        $this->translations = translations('profile-tabs-list');
    }

    public function settings()
    {
        $this->type = 'settings';
        $this->translations = translations('profile-settings-tabs-list');

        return $this;
    }

    public function header()
    {
        $this->type = 'header';
        $this->translations = translations('profile-header-items-list');

        return $this;
    }

    public function makeTab($data)
    {
        // Traducciones
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

        switch ($this->type) {
            case 'settings':
                // Creamos la tab
                $tab = new ProfileTab;
                $tab->slug = $slug;
                $tab->url = $data['url'];
                $tab->type = "settings";

                if( array_key_exists('order', $data) && !empty($data['order']) ) {
                    $tab->order = $data['order'];
                }

                $tab->save();
                break;

            case 'header':
                // Creamos la tab
                $tab = new ProfileHeaderItem;

                if( array_key_exists('icon', $data) && !empty($data['icon']) ) {
                    $tab->icon = $data['icon'];
                }

                if( array_key_exists('order', $data) && !empty($data['order']) ) {
                    $tab->order = $data['order'];
                }

                if( array_key_exists('type', $data) && !empty($data['type']) ) {
                    $tab->type = $data['type'];
                }

                $tab->slug = $slug;
                $tab->url = $data['url'];
                $tab->save();
                break;

            default:
                // Creamos la tab
                $tab = new ProfileTab;
                $tab->slug = $slug;
                $tab->url = $data['url'];
                $tab->type = "profile";

                if( array_key_exists('order', $data) && !empty($data['order']) ) {
                    $tab->order = $data['order'];
                }

                $tab->save();
                break;
        }

        // Exportamos la traducciín a la carpeta LANG
        $this->translations->publish();
    }

}
