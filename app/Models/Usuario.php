<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Usuario extends Authenticatable
{
    use HasApiTokens;
    use HasUuids;

    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = ['usuario_contra'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }
}
