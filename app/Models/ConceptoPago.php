<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ConceptoPago extends Model
{
    use HasUuids;

    protected $table = 'conceptos_pago';
    public $timestamps = false;
    protected $primaryKey = 'concepto_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        // 'concepto_id',
        'institucion_id',
        'concepto_nombre',
        'concepto_valor',
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'concepto_id', 'concepto_id');
    }
}
