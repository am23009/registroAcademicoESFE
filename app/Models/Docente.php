<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Docente extends Authenticatable
{
    use HasFactory;

    protected $table = 'docente';
    public $timestamps = false; 

    protected $fillable = ['nombre', 'apellido', 'email', 'password'];
}
