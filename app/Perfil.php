<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    // Relación de perfil con usuario

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
