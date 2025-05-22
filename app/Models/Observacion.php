<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observaciones';
    protected $primaryKey = 'observacion_id';
    public $timestamps = false;
}
