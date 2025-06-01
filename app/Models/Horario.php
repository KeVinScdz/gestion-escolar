<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasUuids;

    protected $table = 'horarios';
    public $timestamps = false;
    protected $primaryKey = 'horario_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        // 'horario_id',
        'bloque_id',
        'asignacion_id',
    ];

    public function bloque()
    {
        return $this->belongsTo(Bloque::class, 'bloque_id', 'bloque_id');
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id', 'asignacion_id');
    }
}
