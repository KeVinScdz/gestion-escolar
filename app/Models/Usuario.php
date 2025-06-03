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
    public $timestamps = true;
    protected $primaryKey = 'usuario_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $hidden = ['usuario_contra'];

    protected $fillable = [
        // 'usuario_id',
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
        'created_at',
        'updated_at',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'rol_id');
    }

    public function setUsuarioContraAttribute($value)
    {
        $this->attributes['usuario_contra'] = Hash::make($value);
    }

    public function administrativo()
    {
        return $this->hasOne(Administrativo::class, 'usuario_id', 'usuario_id');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'usuario_id', 'usuario_id');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'usuario_id', 'usuario_id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'usuario_id', 'usuario_id');
    }

    public function scopeSearch($query, $term)
    {
        if (empty($term)) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('usuario_nombre', 'like', "%{$term}%")
                ->orWhere('usuario_id', 'like', "%{$term}%")
                ->orWhere('usuario_apellido', 'like', "%{$term}%")
                ->orWhere('usuario_correo', 'like', "%{$term}%")
                ->orWhere('usuario_documento', 'like', "%{$term}%");
        });
    }
}
