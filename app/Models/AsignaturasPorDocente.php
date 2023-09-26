<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaturasPorDocente extends Model
{
    use HasFactory;
    protected $table = "asignaturas_por_docente";
    protected $fillable = [
        'identificacion',
        'codigo_asignatura',
        'asignatura',
        'grupo',
        'horas',
        'programa',
        'año',
        'periodo'
    ];

    public function asignacion()
    {
        return $this->BelongsTo(Asignacion::class,'identificacion','identificacion');
    }
}
