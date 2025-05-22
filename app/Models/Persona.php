<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'persona_id';
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'persona_id', 'persona_id');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'persona_id', 'persona_id');
    }

    public function administrativo()
    {
        return $this->hasOne(Administrativo::class, 'persona_id', 'persona_id');
    }
}
