<?php

namespace App\Kernel\Helpers;

class Modules 
{
	protected $module;
	protected $isMigrated = false;
	protected $isPublished = false;

	public function load($dir)
	{
		$this->module = new \Nwidart\Modules\Json($dir . '/module.json');
	}

	private function isInstalled($module = null)
	{
		if(is_null($module)) {
			$module = $this->module->name;
		}
		
		$slug_module = str_slug($module, '-');

		$cache = cache("module['$slug_module']");

		if( !$cache ) {

			$_moduleCount = \App\Module::where('name', $module)->count();

			if( $_moduleCount > 0 ) {	
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

	public function install(callable $callback)
	{
		// Verificamos si el modulo esta instalado.
		if(!$this->isInstalled()) {

			// Obtenemos las dependencias.
			$dependencias = $this->module->requires;

			// Verificamos que estén instaladas las dependencias.
			foreach($dependencias as $data) {
				if(! $this->isInstalled($data)){
					// Obtenemos las dependencias desde el servidor
					// module_download($data);
					// Instalamos las dependencias.
					// module_install($data);
				}
			}

			// Creamos el registro en la base de datos.
			$slug_module = str_slug($this->module->name);

			$_module = \App\Module::create([
				'name' => $this->module->name, 
				'slug' => $slug_module
			]);

			$expireAt = now()->addYear(5);
			
			cache([
				"module['$slug_module']" => true
			], $expireAt);

			// Llamamos la función callback
			call_user_func($callback, $this);
		}
	}

	public function migrate($seed = false)
	{
		if(!$this->isMigrated) {
			// Establecemos el tiempo de respuesta max
			set_time_limit(600);

			// Ejecutamos las migraciones
			\Artisan::call("module:migrate", [
				'module' => $this->module->name
			]);

			if($seed) {
				\Artisan::call("module:seed", [
					'module' => $this->module->name
				]);
			}

			$this->isMigrated = true;
		}

		return $this;
	}

	public function publish($force = false)
	{
		if(!$this->isPublished || $force) {
			// Establecemos el tiempo de respuesta max
			set_time_limit(600);

			// Ejecutamos las migraciones
			\Artisan::call("module:publish", [
				'module' => $this->module->name
			]);

			$this->isPublished = true;
		}
	}

}
