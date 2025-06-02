<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasUuids;

    protected $table = 'instituciones';
    public $timestamps = false;
    protected $primaryKey = 'institucion_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'institucion_id',
        'institucion_nombre',
        'institucion_telefono',
        'institucion_correo',
        'institucion_direccion',
        'institucion_nit',
        'nota_minima',
        'nota_maxima',
        'nota_aprobatoria',
    ];

    public function niveles()
    {
        return $this->hasMany(Nivel::class, 'institucion_id', 'institucion_id');
    }

    public function periodosAcademicos()
    {
        return $this->hasMany(PeriodoAcademico::class, 'institucion_id', 'institucion_id');
    }

    public function scopeSearch($query, $term)
    {
        if (empty($term)) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('institucion_nombre', 'like', "%{$term}%")
                ->orWhere('institucion_correo', 'like', "%{$term}%")
                ->orWhere('institucion_nit', 'like', "%{$term}%")
                ->orWhere('institucion_direccion', 'like', "%{$term}%");
        });
    }
}
