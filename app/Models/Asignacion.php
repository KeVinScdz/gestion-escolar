<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';
    protected $primaryKey = 'asignacion_id';
    public $timestamps = false;

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'docente_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'materia_id');
    }
}
