<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    protected $primaryKey = 'nota_id';
    public $timestamps = false;

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'matricula_id');
    }
}
