<?php

use Illuminate\Database\Seeder;

use App\Languaje;

class LanguajesSeeder extends Seeder
{
	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos una nueva traducción
        $translations = translations('languaje-list');

        $languajes = [
            [
                'name' => [
                    'en'  => 'Spanish',
                    'es'  => 'Español',
                    'pt'  => 'Espanhol'
                ], 
                'iso' => 'es'
            ],
            [
                'name' => [
                    'en'  => 'English',
                    'es'  => 'Inglés',
                    'pt'  => 'Inglês'
                ], 
                'iso' => 'en',
                'icon' => 'flag-icon flag-icon-us'
            ],
            [
                'name' => [
                    'en'  => 'Portugués',
                    'es'  => 'Portugués',
                    'pt'  => 'Português'
                ], 
                'iso' => 'pt'
            ],
        ];

        //
        foreach( $languajes as $data ) {
            $arrays = collect($data['name']);
            $slug = str_slug($arrays->first());
            
            $locale = new Languaje;
            $locale->iso = $data['iso'];
            $locale->slug = $slug;
            $locale->icon = array_key_exists('icon', $data) ? $data['icon'] : null;
            $locale->save();

            foreach ($data['name'] as $languaje => $value) {
                // 
                $translations->add($slug, $value, $languaje);
            }
        }

        $translations->publish();
    }
}
