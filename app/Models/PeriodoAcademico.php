<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    protected $table = 'periodos_academicos';
    protected $primaryKey = 'periodo_academico_id';
    public $timestamps = false;

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }
}
