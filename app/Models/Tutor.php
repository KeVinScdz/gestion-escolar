<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tutor extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'tutores';
    protected $primaryKey = 'tutor_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        // 'tutor_id',
        'usuario_id',
        'estudiante_id',
    ];

    /**
     * Get the user that is the tutor.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    /**
     * Get the student associated with the tutor.
     */
    public function estudiante()
    {
        // Assuming you have an Estudiante model
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'estudiante_id');
    }
}
