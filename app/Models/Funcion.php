<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Funcion extends Model
{
    use HasFactory;
    protected $table = "funciones";
    protected $fillable = [
        'funcion',
        'descarga',
    ];

    public function asignacion()
    {
        return $this->belongsToMany(asignacion::class,'funciones_por_asignacion','funcion_id','asignacion_id')->withPivot('soporte');
    }

}
