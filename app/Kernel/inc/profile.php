<?php

if( !function_exists('profile') ) {
	/**
	 *  Profile
	 *	Helper para las tabs del profile.
	 *
	 *  @author alejandro@galej.net 
	 *  @return App\Kernel\Helpers\Profile::class
	 */
	function profile()
	{
		$class = \App::make('App\Kernel\Helpers\Profile');

		return $class;
	}
}