<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $fillable = [
        'periodo',
        'docente',
        'jefe_inmediato',
        'tipo_docente',
        'horas_actividad',
        'tipo_actividad',
        'totalh_docencia',
        'totalh_extension',
        'totalh_investigacion',
        'totalh_administrativa',
        'totalh_otros',
        'programa',
        'facultad'
    ];
    public function programa(){//'programa' en lugar de 'Programa' para seguir las convenciones de nomenclatura de Laravel.
        return $this->hasOne(Programa::class);
    }
    public function facultad(){
        return $this->hasOne(Facultad::class);
    }
}
