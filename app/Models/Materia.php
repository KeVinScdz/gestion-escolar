<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'materia_id';
    public $timestamps = false;

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'materia_id', 'materia_id');
    }
}
