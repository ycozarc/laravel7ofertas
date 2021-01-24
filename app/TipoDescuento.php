<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDescuento extends Model
{
    public function chollos()
    {
        return $this->hasMany(Chollo::class);
    }
}
