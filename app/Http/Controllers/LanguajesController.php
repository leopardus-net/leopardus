<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Languaje;

class LanguajesController extends Controller
{
    public function __construct()
    {
        // Pagina para el menú
        $page = route('languajes.index');

        // Compartimos la variable
        view()->share(compact('page'));
    }
    
    //
    public function index()
    {
    	$languajes = Languaje::paginate(20);

    	return view('admin.settings.languajes.index', compact('languajes'));
    }

    public function store(Request $request)
    {
    	// Validaciones
    	$validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'iso' => 'required|string|unique:languajes,iso|max:5',
            'icon' => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // 
        $translations = translations('languaje-list');
        // Agregamos un nuevo lenguaje
        $translations->addLocale($request->iso);
        
        //
        $lang = new Languaje;
        $lang->slug = str_slug($request->name, '-');
        $lang->iso = $request->iso;
        $lang->icon = $request->icon;
        $lang->save();

        // una para el lenguaje actual
        $translations->add(str_slug($request->name, '-'), $request->name);
        // para el nuevo idioma
        $translations->add(str_slug($request->name, '-'), $request->name, $request->iso);
        // Publicamos las traduciones
        $translations->publish();
        
    	return redirect()->route('languajes.index')->with('action', 'create');
    }

    public function modify($id)
    {
        $languaje = Languaje::findOrFail($id);

        return view('admin.settings.languajes.update', compact('languaje'));
    }

    public function update(Request $request, $id)
    {
        $lang = Languaje::findOrFail($id);

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'iso' => "required|string|unique:languajes,iso,$lang->id,id|max:5",
            'icon' => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $lang->iso = $request->iso;
        $lang->icon = $request->icon;
        $lang->save();

        // Creamos una nueva traducción
        $translations = translations('languaje-list');
        // una para el lenguaje actual
        $translations->add($lang->slug, $request->name);
        // Publicamos las traduciones
        $translations->publish();

        return redirect()->route('languajes.index')->with('action', 'update');
    }

    public function destroy($id)
    {
       $lang = Languaje::findOrFail($id);

       $lang->delete();

       return redirect()->back()->with('action', 'delete');
    }
}
