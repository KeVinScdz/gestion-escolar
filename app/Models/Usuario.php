<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';
    public $timestamps = false;

    protected $hidden = ['usuario_contra'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }

    public function persona()
    {
        return $this->hasOne(Persona::class, 'persona_id', 'persona_id');
    }
}
