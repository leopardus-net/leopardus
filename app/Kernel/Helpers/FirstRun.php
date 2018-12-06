<?php
/**
 * 
 */
class FirstRun
{
	private $base_path = __DIR__.'/../../..';

	public function checkVersionPHP()
	{
		return version_compare(phpversion(), '7.1.3', '>=');
	}

	public function checkExtensionsPHP()
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

	public function checkSettingsPHP()
	{
		return true;
	}

	public function checkDirsPermission()
	{
		// Comprobamos que exista el .env
		return !true;
	}

	public function checkFilesPermission()
	{
		// Comprobamos que las carpetas del sistema tengan los permisos necesarios.
		return !true;
	}

	public function check()
	{
		// Hacemos todas las comprobaciones 
		// de no existir mostramos los errores en pantalla.

		return false;
	}

	public function showErrors()
	{
		// Mostramos los errores.
		require_once($this->base_path . '/resources/views/errors/first_run.php');

		exit;
	}
	
}