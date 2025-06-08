<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitudEstudiante extends Model
{
    use HasUuids;

    protected $table = 'solicitudes_estudiantes';
    protected $primaryKey = 'solicitud_estudiante_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'solicitud_id',
        'estudiante_nombre',
        'estudiante_apellido',
        'estudiante_documento_tipo',
        'estudiante_documento',
        'estudiante_nacimiento',
    ];

    protected $casts = [
        'estudiante_nacimiento' => 'date',
    ];

    public function solicitud(): BelongsTo
    {
        return $this->belongsTo(SolicitudMatricula::class, 'solicitud_id');
    }
}
