<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';
    protected $primaryKey = 'institucion_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'institucion_id',
        'institucion_nombre',
        'institucion_telefono',
        'institucion_correo',
        'institucion_direccion',
        'institucion_nit',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->institucion_id)) {
                $model->institucion_id = (string) Str::uuid();
            }
        });
    }

    public function niveles()
    {
        return $this->hasMany(Nivel::class, 'institucion_id', 'institucion_id');
    }

    public function periodosAcademicos()
    {
        return $this->hasMany(PeriodoAcademico::class, 'institucion_id', 'institucion_id');
    }

    // Search scope for filtering by nombre, correo, nit, etc.
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
