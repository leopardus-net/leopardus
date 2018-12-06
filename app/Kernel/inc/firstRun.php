<?php

if( !function_exists('first_run') ) {
	/**
	 *  First Run
	 *	Helper para el primer arranque.
	 *
	 *  @author alejandro@galej.net 
	 *  @return App\Kernel\Helpers\FirstRun::class
	 */
	function first_run()
	{
		include_once __DIR__ . '/../Helpers/FirstRun.php';

		$class = new FirstRun;

		return $class;
	}
}