<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Administrativo extends Model
{
    use HasUuids;

    protected $table = 'administrativos';
    protected $primaryKey = 'administrativo_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        // 'administrativo_id',
        'usuario_id',
        'administrativo_cargo',
        'institucion_id',
        'created_at',
        'updated_at'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'institucion_id');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'administrativos_permisos', 'administrativo_id', 'permiso_id');
    }
}
