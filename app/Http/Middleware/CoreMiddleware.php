<?php

namespace App\Http\Middleware;

use Closure;

use App\Setting;
use App\LeftSidebar;
use App\Languaje;
use App\ProfileHeaderItem;

class CoreMiddleware
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
        $isInstalled = sys_installed();

        if( !$isInstalled ) {

            $current_route = $request->getPathInfo();

            if( $current_route != '/install' && $current_route != '/' ) {
                return redirect()->route('install.index');   
            }

            $settings = $_defaultSettings = (object)[
                'name' => 'Leopardus',
                'slogan' => 'Modular and Multilanguage system.', 
                'description' => 'Open source, modular and multilanguage system based on Laravel. For the creation of personal or business web tools.',
                'version' => '0.18.0'
            ];
        } else {
            // Obtenemos la configuración del sitio.
            $settings = Setting::first();
            $languajes = Languaje::all();
            $leftSidebar = LeftSidebar::orderBy('order', 'asc')->get();
            $headerProfileItems = ProfileHeaderItem::orderBy('order', 'asc')->get();

            view()->share( compact('leftSidebar', 'languajes', 'headerProfileItems') );
        }

        view()->share(compact('settings', 'isInstalled'));
        
        // Response
        return $next($request);
    }
}
