<?php

namespace App\Kernel\Helpers;

use App\LeftSidebar as LeftSidebars;
use App\LeftSidebarItem;

class LeftSidebar 
{
	//
	protected $sidebar;
    protected $translations;
    protected $_sidebar;
    protected $_root_parent;
    protected $_parent;

    function __construct() {
        $this->translations = translations('left-sidebar');
    }

    public function load($sidebar = null, $root_parent = null, $parent = null)
    {
    	$this->_sidebar = $sidebar;
    	$this->_root_parent = $root_parent;
    	$this->_parent = $parent;
    }

    private function getSidebar()
    {
    	$this->sidebar = LeftSidebars::where('slug', $this->_sidebar)
                            ->first();

    	return $this->sidebar;
    }

    private function getParent($slug)
    {
    	$parent = LeftSidebarItem::where('slug', $slug)
                    ->where('sidebar_id', $this->sidebar->id)
                    ->first();

    	return $parent;
    }

    private function create_sidebars($array)
    {
    	foreach($array as $data) {
        	//
        	$this->create_sidebar($data);
        }
    }

    private function create_sidebar($data)
    {
        if( !is_array( $data['name'] ) ) {
            // 
            $slug = str_slug($data['name'], '-'); 
            $key = $slug . '.name';
            // Obtenemos los lenguajes instalados.
            foreach ( $this->translations->getLocales() as $locale) {
                // Creamos una nueva traducción
                $this->translations->add($key, $data['name'], $locale);
            }
        } else {
            //
            $arrays = collect($data['name']);
            $slug = str_slug($arrays->first(), '-');
            $key = $slug . '.name';
            // recorremos los nombres.
            foreach ($data['name'] as $locale => $value) {
                $this->translations->add($key, $value, $locale);
            }
        }

    	// Creamos un nuevo sidebar
    	$sidebar = new LeftSidebars;
        $sidebar->slug = $slug;
        
        if( array_key_exists('order', $data) ) {
            $sidebar->order = (int) $data['order'];
        }

    	$sidebar->save();

        $this->sidebar = $sidebar;

        // Creamos los items.
        if(array_key_exists('items', $data) && count($data['items']) > 0) {
	        $this->create_items($data['items']);
	    }

        // Retornamos el sidebar
        return $sidebar;
    }

    private function create_items($items, $parent = null)
    {
    	foreach($items as $data) {
    		$this->create_item($data, $parent);
    	}
    }

    private function create_item($data, $parent = null)
    {
        if( is_array($data['name']) ) {
            //
            $arrays = collect($data['name']);
            $slug = str_slug($arrays->first(), '-');
        } elseif(is_string($data['name'])) {
            // 
            $slug = str_slug($data['name'], '-'); 
        } else {
            return "Error: the parameter name is not of type array or string";
        }    	
            	
    	$item = new LeftSidebarItem;
        $item->slug = $slug;
    	$item->sidebar_id = $this->sidebar->id;
        $item->parent_id = $parent ? $parent->id : 0;

        if( array_key_exists('icon', $data) ) {
    	   $item->icon = (string) $data['icon']; 
        }

        if( array_key_exists('order', $data) && !empty($data['order']) ) {
            $item->order = (int) $data['order'];
        }
    	
    	if( array_key_exists('route', $data) && !empty($data['route']) ) {
    		$item->route = (string) $data['route'];
    	}

    	$item->save();
    	
    	// key
    	$key = $this->sidebar->slug;
        $childrens = '.childrens.';
        $footer = '.name';
		
    	if( $item->parent_id ) {
			if( $item->parent->parent_id ) {
                if( $item->parent->parent->parent_id ) {
                    $key .= $childrens . $item->parent->parent->parent->slug;
                }
				$key .= $childrens . $item->parent->parent->slug;
			}
			$key .= $childrens . $item->parent->slug;
    	}

    	$key .= $childrens . $item->slug;
		$key .= $footer;

        if( is_array( $data['name'] ) ) {
            //
            foreach ($data['name'] as $locale => $value) {
                $this->translations->add($key, $value, $locale);
            }
        } else {
            // Obtenemos los lenguajes instalados.
            foreach ( $this->translations->getLocales() as $locale) {
                // Creamos una nueva traducción
                $this->translations->add($key, $data['name'], $locale);
            }
        }

        if( array_key_exists('items', $data) && count($data['items']) > 0 ) {
	        $this->create_items($data['items'], $item);
	    }
    }

    public function make($array)
    {
    	if( is_null( $this->_sidebar ) ) {
    		// Creamos el sidebar junto a los item.
    		$this->create_sidebars($array);
    	} else {
    		
    		// Obtenemos el sidebar.
    		$sidebar = $this->getSidebar();
    		//
    		if( !$sidebar ) 
    				return 'Error: Sidebar no encontrado.';
    		
    		if( is_null( $this->_root_parent ) ) {
    			// Creamos los items
				$this->create_items($array);
    		} else {
    			// Obtenemos el item padre
    			$root_parent = $this->getParent( $this->_root_parent );
    			//
    			if( !$root_parent ) 
    				return 'Error: Item no encontrado.';

    			//
    			if( is_null( $this->_parent ) ) {
    				// Creamos los items
    				$this->create_items($array, $root_parent);
    			} else {
    				// Obtenemos el item padre
    				$parent = $this->getParent( $this->_parent );
    				//
    				if( !$parent ) 
    					return 'Error: Item no encontrado.';

					// Creamos los items
    				$this->create_items($array, $parent);
    			}
    		}
    	}

        // Exportamos la traducciín a la carpeta LANG
    	$this->translations->publish();
    }
}
