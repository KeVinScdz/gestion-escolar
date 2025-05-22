<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'docente_id';
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'persona_id');
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'docente_id', 'docente_id');
    }
}
