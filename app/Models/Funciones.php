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
        'descarga',
    ];

    public function asignacion()
    {
        return $this->belongsToMany(asignacion::class);
    }

}
