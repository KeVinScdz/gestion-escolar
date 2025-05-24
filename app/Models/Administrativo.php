<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $table = 'administrativos';
    protected $primaryKey = 'administrativo_id';
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }
}
