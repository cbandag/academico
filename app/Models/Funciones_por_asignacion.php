<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Funciones_por_asignacion extends Model
{
    use HasFactory;
    protected $table = "funciones_por_asignacion";
    protected $fillable = [
        'asignacion_id',
        'funcion_id',
        'soporte'
    ];



/*
    public function programa(){
        return $this->hasOne(Programa::class);
    }
    public function facultad(){
        return $this->hasOne(Facultad::class);
    }*/
}
