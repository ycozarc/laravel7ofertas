<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Evento cuando se registra usuario

    protected static function boot()
    {
        parent::boot();

        // Perfil al usuario nuevo

        static::created(function ($user){
            $user->perfil()->create();
            $user->perfil->imagen = 'upload-perfiles/avatar.jpg';
            $user->perfil->save();
        });
    }

    //Relacion 1:n de usuarios a chollos
    public function chollos()
    {
        return $this->hasMany(Chollo::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    //Métodos roles

    public function rolesAutorizados($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->tieneRol($role)) {
                    return true;
                }
            }
        } else {
            if ($this->tieneRol($roles)) {
                 return true; 
            }   
        }
        return false;
    }
    
    public function tieneRol($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    //Relación usuario y perfil

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    // Ver si esta online

    public function isOnline()
{
    return Cache::has('user-is-online-' . $this->id);
}

    // Comentarios

    public function comentarios() 
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Chollo::class, 'likes_chollo');
    }

    public function follow()
    {
        return $this->belongsToMany(Chollo::class, 'follows_chollo');
    }
}
