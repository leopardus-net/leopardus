<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Pagina para el menú
        $page = route('dashboard.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }

    //
    public function index(Request $request)
    {
    	return view('admin.dashboard.index');
    }
}
