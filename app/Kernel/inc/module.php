<?php

if( !function_exists('module') ) {
	/**
	 *  Module
	 *	Helper para el manejo de los modulos.
	 *
	 *  @author alejandro@galej.net 
	 *  @return App\Kernel\Helpers\Module::class
	 */
	function module($module)
	{
		$class = \App::make('App\Kernel\Helpers\Modules');

		$class->load($module);

		return $class;
	}
}