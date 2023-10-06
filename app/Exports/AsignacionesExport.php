<?php

namespace App\Exports;

use App\Models\Asignacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;

class AsignacionesExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Asignacion::all();

        return DB::table('asignaciones')
                    ->join('users', 'asignaciones.identificacion', '=', 'users.identificacion')
                    ->select('users.nombres',
                            'users.apellidos',
                            'asignaciones.identificacion',
                            'asignaciones.horas_dedicacion',
                            'asignaciones.descarga_investigacion',
                            'asignaciones.descarga_extension',
                            'asignaciones.soporte',
                            'asignaciones.observaciones',
                            'asignaciones.estado')
                            ->get();


        return Asignacion::select('identificacion',
                            'horas_dedicacion',
                            'descarga_investigacion',
                            'descarga_extension',
                            'soporte',
                            'observaciones',
                            'estado')->get();
        



    }

    public function headings(): array
    {
        return ['nombres',
            'apellidos',
            'identificacion',
            'horas_dedicacion',
            'descarga_investigacion',
            'descarga_extension',
            'soporte',
            'observaciones',
            'estado',
        ];
    }
}
