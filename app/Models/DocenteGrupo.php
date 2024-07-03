<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteGrupo extends Model
{
    use HasFactory;
    
    protected $table = 'docente_grupo';
    public $timestamps = false;
    
    protected $fillable = ['docente_id', 'group_id'];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'group_id');
    }


}
