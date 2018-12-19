<?php

class FirstRun
{
	private $base_path = __DIR__.'/../../..';
	private $errors = [];

	private function checkVersionPHP()
	{
		if(!version_compare(phpversion(), '7.1.3', '>=')) {
			$this->errors[] = "The PHP version must be >= 7.1.3";
			return false;
		}
		
		return true;
	}

	private function checkExtensionsPHP()
	{
		$extensions = [
			'OpenSSL',
			'PDO',
			'Mbstring',
			'Tokenizer',
			'XML',
			'Ctype',
			'JSON',
			'BCMath'
		];

		$errors = [];

		foreach ($extensions as $ext) {
			if(phpversion($ext) == false) {
				$errors[] = "The extension is not found: " . $ext;
				//return false;
			}
		}

		if(count($errors)) {
			$this->errors += $errors;
			return false;
		}

		return true;
	}

	private function checkSettingsPHP()
	{
		return true;
	}

	private function checkDirsPermission()
	{
		$dirs = [
			['path' => '/resources/lang', 'recursive' => true],
			['path' => '/storage', 'recursive' => true],
			['path' => '/public', 'recursive' => false],
			['path' => '/public/modules', 'recursive' => false],
			['path' => '/bootstrap/cache', 'recursive' => true]
		];

		$errors = [];
		//
		foreach($dirs as $dir) {
			if(!$this->checkDir($dir))
				return false;
		}

		return true;
	}

	private function checkDir($dir)
	{
		$route = $this->base_path . $dir['path'];

		if(is_dir($route) && !is_file($route)) {
			if(is_writable($route)) {
				if($dir['recursive']) {
					$objects = scandir($route);

					foreach ($objects as $object) {
						if ($object != "." && $object != ".." && $object != "/") {
							$route = $dir['path'] . '/' . $object;
							if(!is_file($this->base_path . $route)) {
								if(!$this->checkDir( ['path' => $route, 'recursive' => true])) {
									return false;
								}
							}
						}
					}   
				}
			} else {
				$this->errors[] = "Path not writable: " . $route;
				return false;
			}
		} else {
			$this->errors[] = "Path not found: " . $route;
			return false;
		}

		return true;
	}

	private function checkFilesPermission(): bool
	{
		$env = $this->base_path . '/.env';
		$example = $this->base_path . '/.env.example';

		if(file_exists($env)) {
			if(is_writable($env)) {
				return true;
			} else {
				$this->errors[] = "File not writable: /.env";
			}
		} else {
			$this->errors[] = "File not found: /.env";
		}

		return false;
	}

	private function envToArray($file): array
    {
        $string = file_get_contents($file);
        $string = preg_split('/\n+/', $string);
        $returnArray = array();

        foreach($string as $one){
            if (preg_match('/^(#\s)/', $one) === 1 || preg_match('/^([\\n\\r]+)/', $one)) {
                continue;
            }
            $entry = explode("=", $one, 2);
            $returnArray[$entry[0]] = isset($entry[1]) ? $entry[1] : null;
        }

        return array_filter($returnArray,function($key) { return !empty($key);},ARRAY_FILTER_USE_KEY);
    }

	private function checkEnvKey(): bool
	{
		$env = $this->envToArray($this->base_path . '/.env');

		if(empty($env['APP_KEY'])) {
			$this->errors[] = "[APP_KEY] not set in /.env";
			return false;
		}

		return true;

	}

	public function check(): bool
	{
		$this->checkVersionPHP();
		$this->checkSettingsPHP();
		$this->checkExtensionsPHP();
		$this->checkDirsPermission();
		$this->checkFilesPermission();
		$this->checkEnvKey();

		if(count($this->errors)) {
			return false;
		}
			
		return true;
	}

	public function showErrors()
	{
		// Mostramos los errores.
		$this->view('errors/first_run');
	}
	
	private function view($path)
	{
		$view = $this->base_path . '/resources/views/' . $path . '.php';

		if(file_exists($view))
			require_once($view);
	}
}