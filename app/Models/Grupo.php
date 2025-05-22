<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $primaryKey = 'grupo_id';
    public $timestamps = false;

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id', 'grado_id');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'grupo_id', 'grupo_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'grupo_id', 'grupo_id');
    }
}
