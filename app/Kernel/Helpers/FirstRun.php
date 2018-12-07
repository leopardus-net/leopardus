<?php
/**
 * 
 */

class FirstRun
{
	private $base_path = __DIR__.'/../../..';

	private function checkVersionPHP()
	{
		if(version_compare(phpversion(), '7.1.3', '>='))
			return true;

		return false;
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

		foreach ($extensions as $ext) {
			if(phpversion($ext) == false) {
				return false;
			}
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
			['path' => '/bootstrap/cache', 'recursive' => true]
		];

		foreach($dirs as $dir) {
			if(!$this->checkDir($dir))
				return false;
		}

		return true;
	}

	private function checkDir($dir)
	{
		if(is_dir($this->base_path . $dir['path'])) {
			if(is_writable($this->base_path . $dir['path'])) {
				if($dir['recursive']) {
					$objects = scandir($this->base_path . $dir['path']);

					foreach ($objects as $object) {
						if ($object != "." && $object != "..") {
						   $this->checkDir( ['path' => $dir['path'] . '/'. $object, 'recursive' => true]);
						}
					}   
				}
			} else {
				return false;
			}
		} else {
			return false;
		}

		return true;
	}

	private function checkFilesPermission()
	{
		$env = $this->base_path . '/.env';
		$example = $this->base_path . '/.env.example';

		if(file_exists($env)) {
			if(is_writable($env)) {
				return true;
			}
		}

		return false;
	}

	private function envToArray($file)
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

	private function checkEnvKey()
	{
		$env = $this->envToArray($this->base_path . '/.env');

		return !empty($env['APP_KEY']);

	}

	public function check()
	{
		$check 	= 	$this->checkVersionPHP() &&
					$this->checkSettingsPHP() &&
					$this->checkExtensionsPHP() &&
					$this->checkDirsPermission() &&
					$this->checkFilesPermission() &&
					$this->checkEnvKey();

		return $check;
	}

	public function showErrors()
	{
		// Mostramos los errores.
		return $this->view('errors/first_run');
	}
	
	private function view($path)
	{
		$view = $this->base_path . '/resources/views/' . $path . '.php';

		if(file_exists($view))
			require_once($view);
	}
}