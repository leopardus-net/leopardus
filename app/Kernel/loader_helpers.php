<?php

if( !function_exists('load_helpers')) {

	function load_helpers($dir)
	{
		if ($dh = opendir($dir)) {
		    while (($file = readdir($dh)) !== false) {
		        if (!is_dir($dir . $file) && $file != "." && $file != "..") {
		            include_once $dir . $file;
		        } elseif ($file != "." && $file != "..") {
		            load_helpers($dir . $file . '/');
		        }
		    }
		    closedir($dh);
		}

	}
}

load_helpers(__DIR__ . '/inc/');