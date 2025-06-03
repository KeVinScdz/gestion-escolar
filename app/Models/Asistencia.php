<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasUuids;

    protected $table = 'asistencias';
    public $timestamps = false;
    protected $primaryKey = 'asistencia_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        // 'asistencia_id',
        'matricula_id',
        'asistencia_fecha',
        'asistencia_estado',
        'asistencia_motivo',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'matricula_id');
    }
}