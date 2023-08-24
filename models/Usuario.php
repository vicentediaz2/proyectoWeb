<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nombre','correo','contra','role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function producto()
    {
        return $this->hasMany(Producto::class);
    }
}

