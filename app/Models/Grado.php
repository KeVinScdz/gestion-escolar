<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';
    protected $primaryKey = 'grado_id';
    public $timestamps = false;

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id', 'nivel_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'grado_id', 'grado_id');
    }
}
