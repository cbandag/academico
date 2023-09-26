<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;
    protected $table = "programaciones";
    protected $fillable = [
        'codigo_programa',
        'programa',
        'codigo_materia',
        'materia',
        'nombres',
        'apellidos',
        'identificacion',
        'npqprf',
        'estado',
        'email',
        'password'
    ];
}
