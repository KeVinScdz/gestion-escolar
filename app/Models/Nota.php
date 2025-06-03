<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasUuids;

    protected $table = 'notas';
    public $timestamps = false;
    protected $primaryKey = 'nota_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        // 'nota_id',
        'matricula_id',
        'asignacion_id',
        'periodo_academico_id',
        'nota_valor',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'matricula_id');
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id', 'asignacion_id');
    }

    public function periodoAcademico()
    {
        return $this->belongsTo(PeriodoAcademico::class, 'periodo_academico_id', 'periodo_academico_id');
    }
}
