<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasUuids;

    protected $table = 'bloques';
    public $timestamps = false;
    protected $primaryKey = 'bloque_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        // 'bloque_id',
        'institucion_id',
        'bloque_dia',
        'bloque_inicio',
        'bloque_fin',
    ];

    public function asignaciones()
    {
        return $this->belongsToMany(Asignacion::class, 'horarios', 'bloque_id', 'asignacion_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'bloque_id', 'bloque_id');
    }
}
