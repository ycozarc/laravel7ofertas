<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_chollos')->insert([
            'nombre' => 'Informatica',
            'descripcion' => 'Productos de informática',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Hogar',
            'descripcion' => 'Productos del hogar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Videojuegos',
            'descripcion' => 'Productos de videojuegos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Moviles',
            'descripcion' => 'Productos acerca moviles',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Ropa',
            'descripcion' => 'Productos de ropa',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Calzado',
            'descripcion' => 'Productos acerca de calzado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Electrodomésticos',
            'descripcion' => 'Productos relacionados con electrodomésticos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_chollos')->insert([
            'nombre' => 'Otros',
            'descripcion' => 'Otros productos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
