<?php

namespace App\Kernel\Helpers;

// Manegador de idiomas.
use Barryvdh\TranslationManager\Models\Translation;
use Barryvdh\TranslationManager\Manager;

class Translations 
{
	//
	protected $manager;
	//
    protected $group;
    //

    function __construct(Manager $lang_manager) {
    	
    	$this->manager = $lang_manager;
    }

    public function setGroup($group)
    {
    	$this->group = $group;
    }

    public function add($key, $value, $locale = null)
    {
        if( is_null($locale) ) {
            $locale = session('lang') ? session('lang') : app()->getLocale();
        }

        $translation = Translation::where('locale', $locale)
                            ->where('group', $this->group)
                            ->where('key', $key)
                            ->first();

        if( !$translation ) {
            // Agregamos la traducción.
            $translation = new Translation;
            $translation->key = $key;
            $translation->locale = $locale;
            $translation->group = $this->group;
            $translation->status = Translation::STATUS_SAVED;
        } else {
            // Cambiamos el status
            $translation->status = Translation::STATUS_CHANGED;
        }

        $translation->value = $value;
        $translation->save();

        return $translation;
    }

    public function publish()
    {
        // Exportamos la traducción a la carpeta LANG
        return $this->manager->exportTranslations($this->group, false);
    }

    public function addLocale($locale)
    {
        return $this->manager->addLocale($locale);
    }

    public function getLocales()
    {
        return $this->manager->getLocales();
    }

    public function removeLocale($locale)
    {
        return $this->manager->removeLocale($locale);
    }


}
