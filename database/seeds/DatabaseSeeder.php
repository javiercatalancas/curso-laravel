<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // LLamada a los seeders para cada entidad
        $this ->call(UserSeeder::class);    
        
    }
}
