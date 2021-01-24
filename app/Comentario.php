<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'contenido', 'parent_id', 'chollo_id', 'user_id',
    ];
 
    public function chollo() 
    {
        return $this->belongsTo(Chollo::class);
    }
 
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
 
    public function parent() 
    {
        return $this->belongsTo(Comentario::class, 'parent_id');
    }
 
    public function respuestas() 
    {
        return $this->hasMany(Comentario::class, 'parent_id');
    }
}
