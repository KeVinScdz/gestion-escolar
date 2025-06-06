<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Docente extends Model
{
    use HasUuids;

    protected $table = 'docentes';
    protected $primaryKey = 'docente_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        // 'docente_id',
        'usuario_id',
        'institucion_id',
        'docente_titulo',
        'created_at',
        'updated_at'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'docente_id', 'docente_id');
    }
}
