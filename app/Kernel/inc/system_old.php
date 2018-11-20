<?php

if( !function_exists('sys_configured') ) {
	/**
	 *  System Configured
	 *  Verifica si el sistema ya se encuentra configurado.
	 *
	 *  @author alejandro@galej.net 
	 *  @return bolean
	 */
	function sys_configured()
	{
		$cache = cache('systemConfigured');
		
		if( !$cache ) {
			// Verificamos que exista el .env
			$envPath = __DIR__.'/../../../.env';
			
			if( file_exists($envPath) ) {
				$env = new \Brotzka\DotenvEditor\DotenvEditor();

				try{
		            //
					if( $env->getValue("DB_DATABASE") != 'homestead' ) {

			            $expireAt = now()->addYear(5);
						
						cache([
							"systemConfigured" => true
						], $expireAt);

						return true;
					}

		            return false;	            
		        }catch(DotEnvException $e){
		            echo $e->getMessage();
		        }
			} else {
				return false;
			}

		} else {
			return $cache;
		}
	}
}

if( !function_exists('sys_installed') ) {
	/**
	 *  System Installed
	 *  Verifica si el sistema ya se encuentra instalado.
	 *
	 *  @author alejandro@galej.net 
	 *  @return bolean
	 */
	function sys_installed()
	{
		$cache = cache('systemInstalled');
		
		if( !$cache ) {
			// Verificamos que exista el .env
			$envPath = __DIR__.'/../../../.env';

			if( file_exists($envPath) ) {
				try {
		            $_isConfigured = sys_configured();
		            //
		            if( $_isConfigured ) {
		            	if( \Schema::hasTable('settings') )
		            		if( \App\Setting::first() ) {
		            			// Cache
		            			$expireAt = now()->addYear(5);
								
								cache([
									"systemInstalled" => true
								], $expireAt);

								return true;
		            		}
		            }

		            return false;
		        } catch(DotEnvException $e) {
		            echo $e->getMessage();
		        }
		    } else {
		    	return false;
		    }
		} else {
			return $cache;
		}
	}
}