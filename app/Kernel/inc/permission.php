<?php

if( !function_exists('permissions') ) {
	/**
	 *  Role
	 *	Helper para los roles del sistema.
	 *
	 *  @author alejandro@galej.net 
	 *	@param $name	string|array
	 *  @return App\Kernel\Helpers\Roles::class
	 */
	function permissions($permission = null)
	{
		$class = \App::make('App\Kernel\Helpers\Permissions');

		if(!is_null($permission)){
			$class->get($permission);
		}

		return $class;
	}
}