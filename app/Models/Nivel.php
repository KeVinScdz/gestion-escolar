<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveles';
    protected $primaryKey = 'nivel_id';
    public $timestamps = false;

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }

    public function grados()
    {
        return $this->hasMany(Grado::class, 'nivel_id', 'nivel_id');
    }
}
