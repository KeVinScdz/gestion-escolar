<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'estudiante_id';
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'persona_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'estudiante_id', 'estudiante_id');
    }
}
