<?php

if( !function_exists('leftSidebar') ) {
	/**
     * Manejador del menu lateral izquierdo.
     *
     * @author Alejandro Pérez <alejandro@galej.net>
     * @param  string  $sidebar
     * @param  string  $root_parent
     * @param  string  $parent
     * @return App\Kernel\Helpers\LeftSidebar::class
     */
	function leftSidebar($sidebar = null, $root_parent = null, $parent = null)
	{
		$class = \App::make('App\Kernel\Helpers\LeftSidebar');

		$class->load($sidebar, $root_parent, $parent);

		return $class;
	}
}