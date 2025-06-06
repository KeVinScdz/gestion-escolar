<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Asignacion extends Model
{
    use HasUuids;

    protected $table = 'asignaciones';
    public $timestamps = false;
    protected $primaryKey = 'asignacion_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        // 'asignacion_id',
        'docente_id',
        'materia_id',
        'grupo_id',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'docente_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'materia_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'grupo_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'asignacion_id', 'asignacion_id');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'asignacion_id', 'asignacion_id');
    }
}
