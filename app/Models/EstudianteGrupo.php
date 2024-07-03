<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteGrupo extends Model
{
    use HasFactory;

    protected $table = 'estudiante_grupo';
    public $timestamps = false;


    protected $fillable = [
        'estudiante_id',
        'group_id',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'group_id');
    }
}
