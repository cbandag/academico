<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;
    protected $table = "asignaciones";
    protected $fillable = [
            'identificacion',
            'dedicacion',
            'horas_dedicacion',
            'porcentaje_total_funciones',
            'descarga_investigacion',
            'porcentaje_investigacion',
            'descarga_extension',
            'porcentaje_extension',
            'total_descargas',
            'horas_restantes',
            'horas',
            'total_horas',
            'año',
            'periodo'
    ];


    

    
    public function asignacion(): HasMany
    {
        return $this->hasMany(Asignaturas_por_asignacion::class);
    }

    public function funcion(): BelongsToMany
    {
        return $this->belongsToMany(Funcion::class,'funciones_por_asignacion');
    }
}
