<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inasistencia extends Model
{
    protected $table = 'inasistencias';
    protected $primaryKey = 'inasistencia_id';
    public $timestamps = false;

    protected $fillable = [
        'inasistencia_id',
        'matricula_id',
        'institucion_id',
        'inasistencia_fecha',
        'inasistencia_justificada',
        'inasistencia_motivo',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'matricula_id');
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }
}
