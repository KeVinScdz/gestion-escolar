<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasUuids;

    protected $table = 'pagos';
    public $timestamps = false;
    protected $primaryKey = 'pago_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        // 'pago_id',
        'matricula_id',
        'concepto_id',
        'pago_fecha',
        'pago_valor',
        'pago_estado',
    ];

    public function conceptoPago()
    {
        return $this->belongsTo(ConceptoPago::class, 'concepto_id', 'concepto_id');
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id', 'matricula_id');
    }
}
