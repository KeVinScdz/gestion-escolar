<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativoPermiso extends Model
{
    protected $table = 'administrativos_permisos';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['administrativo_id', 'permiso_id'];

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id', 'administrativo_id');
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'permiso_id', 'permiso_id');
    }
}
