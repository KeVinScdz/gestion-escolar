<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';
    protected $primaryKey = 'matricula_id';
    public $timestamps = false;

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'estudiante_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'grupo_id');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'matricula_id', 'matricula_id');
    }

    public function inasistencias()
    {
        return $this->hasMany(Inasistencia::class, 'matricula_id', 'matricula_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'matricula_id', 'matricula_id');
    }
}
