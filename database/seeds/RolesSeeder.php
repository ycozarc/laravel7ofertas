<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();
        $role = new Role();
        $role->name = 'user';
        $role->description = 'Usuario';
        $role->save();
        $role = new Role();
        $role->name = 'mod';
        $role->description = 'Moderador';
        $role->save();
    }
}
