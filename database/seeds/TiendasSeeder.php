<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tienda_chollos')->insert([
            'nombre' => 'Amazon',
            'descripcion' => 'Amazon',
            'url' => 'https://amazon.es',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tienda_chollos')->insert([
            'nombre' => 'Zalando',
            'descripcion' => 'Zalando',
            'url' => 'https://zalando.es',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tienda_chollos')->insert([
            'nombre' => 'Ebay',
            'descripcion' => 'Ebay',
            'url' => 'https://ebay.es',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tienda_chollos')->insert([
            'nombre' => 'PCComponentes',
            'descripcion' => 'Pccomponentes',
            'url' => 'https://pccomponentes.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    
    }
}
