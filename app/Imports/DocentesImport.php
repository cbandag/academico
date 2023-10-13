<?php

namespace App\Imports;

use App\Models\Docente;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class DocentesImport implements ToCollection, WithHeadingRow
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
            Docente::create([
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'email' => $row['email'],
                'identificacion' => $row['identificacion'],
                'estado' => $row['estado'],
                'nombre' => $row['nombre'],
                'password' => Hash::make($data['identificacion']),
            ]);

            Asignaciones::create([
                'identificacion' => $row['identificacion'],
                'jefe' => $row['jefe']
            ]);

        }
    }
    //La idea es descargarlo vacio, luego llenar manualmente el excel,
    //finalmente importarlo con su identificacion, este se actualizara


    /*public function model(array $row)
    {
        return new Docente([

        ]);
    }*/
}
