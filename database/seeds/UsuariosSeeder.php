<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Yeray',
            'email' => 'correo@correo.com',
            'password' => '12345678',
        ]);

        $user2 = User::create([
            'name' => 'luis',
            'email' => 'correo2@correo.com',
            'password' => '12345678',
        ]);
    }
}
