<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasUuids;

    protected $table = 'matriculas';
    public $timestamps = false;
    protected $primaryKey = 'matricula_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        // 'matricula_id',
        'estudiante_id',
        'grupo_id',
        'matricula_año',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'estudiante_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'grupo_id');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'matricula_id', 'matricula_id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'matricula_id', 'matricula_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'matricula_id', 'matricula_id');
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'matricula_id', 'matricula_id');
    }
}
