<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // insertamos datos con DB
        // DB::table('users')->insert([
        //     'name'=>'Escuela Estech',
        //     'email' => 'info@escuelaestech.es',
        //      bcrypt es una función de laravel para hashear, es una alternativa al Facades Hash
        //     'password' => bcrypt('prueba')
        //]);

        // FACADES
        // for($i = 1; $i < 100; $i++){
        //     DB::table('users')->insert([
        //     'name' => 'Usuario'.$i,
        //     'email' => "usuario$i@gmail.com",
        //     'password' => bcrypt(Str::random(6))
        // ]);
        // }

        // // INSERTAR UN NUEVO USUARIO USANDO EL MODELO DE ELOQUENT A MOCHO
        // User::create([
        //     'name' => 'Another User',
        //     'email' => 'anotheruser@user.com',
        //     'password' => bcrypt('laravel'),
        // ]);

        // // Insertar usando save(), para casos distintos
        // $user = new User;
        // $user->name = 'Eloy';
        // $user->email = 'eloy@gmail.com';
        // $user->password = md5(1234);
        // $user->save();

        // Esto llama a factory para crear 50 usuarios del tirón con los campos del Factory
        factory(\App\User::class)->times(50)->create();
    }
}
