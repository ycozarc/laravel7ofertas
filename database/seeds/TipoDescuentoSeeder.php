<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDescuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_descuentos')->insert([
            'nombre' => 'Oferta',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tipo_descuentos')->insert([
            'nombre' => 'Promoción',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tipo_descuentos')->insert([
            'nombre' => 'Gratuito',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
