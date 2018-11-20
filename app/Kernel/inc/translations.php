<?php

if( !function_exists('translations') ) {
     /**
     * Manejador de traduciones.
     *
     * @author Alejandro Pérez <alejandro@galej.net>
     * @param  string  $group
     * @return App\Kernel\Helpers\Translations::class
     */
     function translations($group = null)
     {
          $class = \App::make('App\Kernel\Helpers\Translations');

          if($group) $class->setGroup($group);

          return $class;
     }
}