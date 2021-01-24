<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Campos que se agregaran

    protected $fillable = [
        'name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
