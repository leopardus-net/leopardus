<?php

function makeWritableRecursiveDir($dir, $perm)
{
	if(is_dir($dir)) {
		if(!is_writable($dir)) {
			chmod($dir, $perm);
		}

		$objects = scandir($base_path . $dir);

		foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
               makeWritableRecursiveDir( $dir . '/'. $object, $perm);
            }
        }   
	}
}

function makeWritableRecursiveDirs($dirs = [], $perm = 0774)
{
	$base_path = __DIR__.'/../..';

	if( is_array($dirs) || is_object($dirs) ) {
		foreach( $dirs as $dir ) {
			makeWritableRecursiveDir($base_path . $dir, $perm);
		}
	} else if( is_string($dirs) ) {
		makeWritableRecursiveDir($base_path . $dirs, $perm);
	}
}

function makeWritableDir($dir, $perm)
{
	if( is_dir($dir) ) {
		if(!is_writable($dir)) {
			chmod($dir, $perm);
		}
	}
}

function makeWritableDirs($dirs = [], $perm = 0774)
{
	$base_path = __DIR__.'/../..';

	if( is_array($dirs) || is_object($dirs) ) {
		foreach( $dirs as $dir ) {
			makeWritableDir($base_path . $dir, $perm);
		}
	} else if( is_string($dirs) ) {
		makeWritableDir($base_path . $dirs, $perm);
	}
}

function checkEnv()
{
	$base_path = __DIR__.'/../..';
	//
	$env = $base_path.'/.env';
	$example = $base_path.'/.env.example';

	if( !file_exists($env) && file_exists($example) ) {
		$perm = 0770;
		copy($example, $env);
		
		if( !is_writable($env) ){
			chmod($env, $perm);
		}

	} else if(file_exists($env)) {

		if( !is_writable($env) ){
			chmod($env, $perm);
		}
	}
}

function initialize($value='')
{
	$dirs = [
		'/public',
		'/storage',
		'/resources/lang',
		'/bootstrap/cache'
	];

	makeWritableDirs( $dirs );

	checkEnv();

}

//initialize();