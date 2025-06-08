<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitudTutor extends Model
{
    use HasUuids;

    protected $table = 'solicitudes_tutores';
    protected $primaryKey = 'solicitud_tutor_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'solicitud_id',
        'tutor_nombre',
        'tutor_apellido',
        'tutor_documento_tipo',
        'tutor_documento',
        'tutor_direccion',
        'tutor_telefono',
        'tutor_correo',
    ];

    protected $casts = [
        'tutor_nacimiento' => 'date',
        'tutor_telefono' => 'decimal:0',
    ];

    public function solicitud(): BelongsTo
    {
        return $this->belongsTo(SolicitudMatricula::class, 'solicitud_id');
    }
}
