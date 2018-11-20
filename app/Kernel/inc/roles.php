<?php

if( !function_exists('roles') ) {
	/**
	 *  Role
	 *	Helper para los roles del sistema.
	 *
	 *  @author alejandro@galej.net 
	 *	@param $name	string|array
	 *  @return App\Kernel\Helpers\Roles::class
	 */
	function roles($role = null)
	{
		$class = \App::make('App\Kernel\Helpers\Roles');

		if(!is_null($role)) {
			$class->get($role);
		}

		return $class;
	}
}