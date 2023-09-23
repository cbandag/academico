<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funciones extends Model
{
    use HasFactory;
    protected $table = "funciones";
    protected $fillable = [
        'funcion',
        'porcentaje_descarga',
    ];

    public function asignacion(): BelongsToMany
    {
        return $this->belongsToMany(asignacion::class,'funciones_por_asignacion');
    }
}
