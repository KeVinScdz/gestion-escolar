<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasUuids;

    protected $table = 'observaciones';
    public $timestamps = false;
    protected $primaryKey = 'observacion_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        // 'observacion_id',
        'matricula_id',
        'observacion_tipo',
        'observacion_descripcion',
        'observacion_fecha',
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
