<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Hash;

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

    protected $fillable = [
        'usuario_id',
        'usuario_nombre',
        'usuario_apellido',
        'usuario_correo',
        'usuario_documento_tipo',
        'usuario_documento',
        'usuario_nacimiento',
        'usuario_direccion',
        'usuario_telefono',
        'usuario_contra',
        'rol_id',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }

    public function setUsuarioContraAttribute($value)
    {
        $this->attributes['usuario_contra'] = Hash::make($value);
    }
}
