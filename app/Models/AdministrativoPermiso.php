<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativoPermiso extends Model
{
    protected $table = 'roles_permisos';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['administrativo_id', 'permiso_id'];
}
