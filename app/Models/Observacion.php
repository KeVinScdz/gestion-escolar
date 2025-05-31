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
        'estudiante_id',
        'observacion_tipo',
        'observacion_descripcion',
        'observacion_fecha',
        'created_at',
        'updated_at',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'estudiante_id');
    }
}
