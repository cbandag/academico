<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planes_de_trabajo extends Model
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
    public function program(){
        return $this->hasOne(Program::class);
    }
    public function facultad(){
        return $this->hasOne(facultades::class);
    }
}
