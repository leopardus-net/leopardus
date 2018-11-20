<?php

if( !function_exists('module_install') ) {
	/**
	 *  Module Install
	 *	Instala un modulo.
	 *
	 *  @author alejandro@galej.net 
	 *  @return bolean
	 */
	function module_install($dir, callable $callback)
	{
		$module = new \Nwidart\Modules\Json($dir . '/module.json');

		$isInstalled = module_installed($module->name);

		if(!$isInstalled) {
			// Obtenemos las dependencias.
			$dependencias = $module->requires;

			// Verificamos que estén instaladas las dependencias.
			foreach($dependencias as $data) {
				if(! module_installed($data)){
					// Obtenemos las dependencias desde el servidor
					// module_download($data);
					// Instalamos las dependencias.
					// module_install($data);
				}
			}

			// Creamos el registro en la base de datos.
			$slug_module = str_slug($module->name);
			$_module = \App\Module::create([
				'name' => $module->name, 
				'slug' => $slug_module
			]);

			$expireAt = now()->addYear(5);
			
			cache([
				"module['$slug_module']" => true
			], $expireAt);

			// Llamamos la función callback
			call_user_func($callback, $module);
		}
	}
}

if( !function_exists('module_migrate') ) {
	/**
	 *  Module Installed
	 *	Verifica si un modulo ya se encuentra instalado.
	 *
	 *  @author alejandro@galej.net 
	 *  @return bolean
	 */
	function module_migrate($name)
	{
		// Establecemos el tiempo de respuesta maximo a 10min.
       	set_time_limit(600);

		$migrate = \Artisan::call("module:migrate", [
			'module' => $name
		]);

		return $migrate;
	}
}

if( !function_exists('module_installed') ) {
	/**
	 *  Module Installed
	 *	Verifica si un modulo ya se encuentra instalado.
	 *
	 *  @author alejandro@galej.net 
	 *  @return bolean
	 */
	function module_installed($name)
	{
		$slug_module = str_slug($name, '-');

		$cache = cache("module['$slug_module']");

		if( !$cache ) {

			$module = \App\Module::where('name', $name)->count();

			if( $module > 0 ) {	
				//
				$expireAt = now()->addYear(5);
				
				cache([
					"module['$slug_module']" => true
				], $expireAt);

				return true;
			}

			return false;
		}

		return $cache;		
	}
}