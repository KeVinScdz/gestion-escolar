<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptoPago extends Model
{
    protected $table = 'conceptos_pago';
    protected $primaryKey = 'concepto_pago_id';
    public $timestamps = false;

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'concepto_pago_id', 'concepto_pago_id');
    }
}
