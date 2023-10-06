<?php

namespace App\Imports;

use App\Models\Asignacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AsignacionesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Asignacion::create([
                'identificacion' => $row['identificacion'],
                'horas_dedicacion' => $row['horas_dedicacion'],
                'funcion_1' => $row['funcion_1'],
                'funcion_2' => $row['funcion_2'],
                'funcion_3' => $row['funcion_3'],
                'funcion_4' => $row['funcion_4'],
                'descarga_investigacion' => $row['descarga_investigacion'],
                'descarga_extension' => $row['descarga_extension'],
                'soporte' => $row['soporte'],
                'observaciones' => $row['observaciones'],
                'estado' => $row['estado']
            ]);
        }
    }
    //La idea es descargarlo vacio, luego llenar manualmente el excel,
    //finalmente importarlo con su identificacion, este se actualizara


    /*public function model(array $row)
    {
        return new Asignacion([

        ]);
    }*/
}
