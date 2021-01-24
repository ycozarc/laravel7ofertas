<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChollosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categoria_chollos', function (Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->timestamps();
        });

        Schema::create('tienda_chollos', function (Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('tipo_descuentos', function (Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        

        Schema::create('chollos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->foreignId('categoria_id')->references('id')->on('categoria_chollos');
            $table->foreignId('tienda_id')->references('id')->on('tienda_chollos');
            $table->string('producto')->nullable();
            $table->string('imagen');
            $table->float('precio_anterior')->nullable();
            $table->float('precio_actual')->nullable();
            $table->float('descuento')->nullable();
            $table->foreignId('tipo_descuento_id')->nullable()->references('id')->on('tipo_descuentos')->onDelete('cascade');
            $table->text('url');
            $table->string('cupon')->nullable();
            $table->boolean('activo');
            $table->boolean('moderado');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_descuentos');
        Schema::dropIfExists('categoria_chollo');
        Schema::dropIfExists('tienda_chollo');
        Schema::dropIfExists('chollos');
    }
}
