<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaChollo extends Model
{
    //Campos que se agregaran

    protected $fillable = [
        'nombre', 'descripcion'];
}
