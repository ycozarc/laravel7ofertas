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
        $this->call(CategoriasSeeder::class);
        $this->call(TipoDescuentoSeeder::class);
        $this->call(TiendasSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(RolesSeeder::class);
         
        // $this->call(UsersTableSeeder::class);
    }
}
