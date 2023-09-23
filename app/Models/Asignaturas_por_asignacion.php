<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaturas_por_asignacion extends Model
{
    use HasFactory;
    protected $table = "asignaturas_por_asignacion";
    protected $fillable = [
        'asignacion',
        'asignatura',
        'horas',
        'programa'
    ];
}
