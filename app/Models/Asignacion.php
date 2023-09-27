<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $table = "asignaciones";
    protected $fillable = [
        'identificacion',
        'horas_dedicacion',
        'funcion_1',
        'funcion_2',
        'funcion_3',
        'funcion_4',
        'descarga_investigacion',
        'porcentaje_investigacion',
        'descarga_extension',
        'porcentaje_extension',
        'total_descargas',
        'horas_restantes',
        'soporte',
        'horas_clases',
        'horas_preparacion',
        'horas_estudiantes',
        'observaciones',
        'horas_docencia',
        'año',
        'periodo',
        'estado'
        ];


        public function asignaturas()
        {
            return $this->hasMany(AsignaturasPorDocente::class,'identificacion','identificacion');
        }
        public function user()
        {
            return $this->BelongsTo(User::class,'identificacion','identificacion');
        }

        public function funcion()
        {
            return $this->belongsToMany(Funcion::class,'funciones_por_asignacion');
        }
}
