<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $table = "asignaciones";
    protected $fillable = [
        'identificacion_docente',
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
        'identificacion_jefe',
        'año',
        'periodo',
        'estado'
        ];

        public function docente()
        {
            return $this->BelongsTo(User::class,'identificacion_docente','identificacion');
        }

        public function jefe()
        {
            return $this->BelongsTo(User::class,'identificacion_jefe','identificacion');
        }

        public function asignaturas()
        {
            return $this->hasMany(AsignaturasPorDocente::class,'asignacion_id','id');
        }


        public function funcion()
        {
            return $this->belongsToMany(Funcion::class,'funciones_por_asignacion');
        }
}
