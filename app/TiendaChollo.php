<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiendaChollo extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'url'];
}
