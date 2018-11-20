<?php

namespace App\Http\Middleware;

use Closure;

use App\Languaje;
use App\Setting;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if( sys_installed() ) {
            if( \Auth::guard($guard)->check() ) {
                //
                $lang = Languaje::find( \Auth::user()->lang );
                
                if( $lang ):
                    // Verificamos la existencia.
                    \App::setLocale( $lang->iso );
                    view()->share('selectedLang', $lang);
                endif;
            } else {
                // Verificamos que el sistema ya esté instalado.
                if( \Schema::hasTable('settings') && $settings = Setting::first()) {
                    //
                    if( session('lang_changed') ) {
                        $lang = Languaje::find( session('lang_id') );
                    } else {
                        $lang = Languaje::find( $settings->lang );
                    }
                    //
                    if( $lang ) {
                        // Establecemos el idioma.
                        \App::setLocale( $lang->iso );
                        view()->share('selectedLang', $lang);
                    }
                }
            }

            if( !isset($lang) || is_null($lang) ) {
                // 
                $lang = (object) ['iso' => 'es', 'icon' => '', 'slug' => 'spanish'];
                //
                view()->share('selectedLang', $lang);
                //
                \App::setLocale( $lang->iso );
            }

        }

        return $next($request);
    }
}
