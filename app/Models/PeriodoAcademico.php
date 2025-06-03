<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    use HasUuids;

    protected $table = 'periodos_academicos';
    public $timestamps = false;
    protected $primaryKey = 'periodo_academico_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        // 'periodo_academico_id',
        'periodo_academico_nombre',
        'periodo_academico_año',
        'periodo_academico_inicio',
        'periodo_academico_fin',
        'institucion_id',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }
    
    public function notas()
    {
        return $this->hasMany(Nota::class, 'periodo_academico_id', 'periodo_academico_id');
    }
}
