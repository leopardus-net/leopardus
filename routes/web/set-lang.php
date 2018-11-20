<?php 

Route::get('/lang/{lang}', function ($lang) {
	// Obtenemos el lenguaje
	$languaje = App\Languaje::where('iso', $lang)->first();

	if( $languaje ) {
		//
	    session(['lang_changed' => 1]);
	    session(['lang_id' => $languaje->id]);
	    session(['lang' => $languaje->iso]);
	    // 
	    if( \Auth::check() ){
	    	$user = \Auth::user();
	    	$user->lang = $languaje->id;
	    	$user->save();
	    }
	    
    	return \Redirect::back();
	}

});