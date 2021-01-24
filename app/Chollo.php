<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chollo extends Model
{
    //Campos que se agregaran

    protected $fillable = [
        'titulo', 'descripcion', 'categoria_id', 'tienda_id', 'producto', 'tipo_descuento_id', 'imagen', 'precio_anterior', 'precio_actual', 'descuento', 'url', 'cupon', 'activo', 'moderado'
    ];

    // Obtener categoria chollo
    public function categoria()
    {
        return $this->belongsTo(CategoriaChollo::class);
    }

    //Obtener tienda chollo

    public function tienda()
    {
        return $this->belongsTo(TiendaChollo::class);
    }

    // Obtener tipo de descuento

    public function tipoDescuento()
    {
        return $this->belongsTo(TipoDescuento::class);
    }

    // Relación 1:n de chollos a usuarios
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comentarios() 
    {
        return $this->hasMany(Comentario::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_chollo');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows_chollo');
    }
}
