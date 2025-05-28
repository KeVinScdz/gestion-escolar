<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasUuids;

    protected $table = 'materias';
    public $timestamps = false;
    protected $primaryKey = 'materia_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        // 'materia_id',
        'materia_nombre',
        'institucion_id',
    ];

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'materia_id', 'materia_id');
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }
}
