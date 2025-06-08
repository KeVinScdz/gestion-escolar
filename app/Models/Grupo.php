<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasUuids;

    protected $table = 'grupos';
    public $timestamps = false;
    protected $primaryKey = 'grupo_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        // 'grupo_id',
        'grado_id',
        'institucion_id',
        'grupo_nombre',
        'grupo_cupo',
        'grupo_año',
        'created_at',
        'updated_at',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id', 'grado_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'grupo_id', 'grupo_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'grupo_id', 'grupo_id');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'grupo_id', 'grupo_id');
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }
}
