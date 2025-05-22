<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';
    protected $primaryKey = 'institucion_id';
    public $timestamps = false;

    public function niveles()
    {
        return $this->hasMany(Nivel::class, 'institucion_id', 'institucion_id');
    }

    public function periodosAcademicos()
    {
        return $this->hasMany(PeriodoAcademico::class, 'institucion_id', 'institucion_id');
    }
}
