<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('chollo_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
 
            $table->foreign('parent_id')->references('id')->on('comentarios')->onDelete('cascade');
            $table->foreign('chollo_id')->references('id')->on('chollos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
