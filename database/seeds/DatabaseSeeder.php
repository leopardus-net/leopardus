<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $seeders = [
        LanguajesSeeder::class,
        PermissionsRolesSeeder::class,
        LeftSidebarSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);
    }
}
