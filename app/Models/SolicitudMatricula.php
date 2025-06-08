<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SolicitudMatricula extends Model
{
    use HasUuids;

    protected $table = 'solicitudes_matricula';
    protected $primaryKey = 'solicitud_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'institucion_id',
        'estudiante_id',
        'grado_id',
        'solicitud_año',
        'solicitud_estado',
        'solicitud_comentario',
    ];

    public function institucion(): BelongsTo
    {
        return $this->belongsTo(Institucion::class, 'institucion_id');
    }

    public function grado(): BelongsTo
    {
        return $this->belongsTo(Grado::class, 'grado_id');
    }

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function tutorNuevo(): HasOne
    {
        return $this->hasOne(SolicitudTutor::class, 'solicitud_id');
    }

    public function estudianteNuevo(): HasOne
    {
        return $this->hasOne(SolicitudEstudiante::class, 'solicitud_id');
    }
}
