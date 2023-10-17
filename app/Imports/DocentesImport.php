<?php

namespace App\Imports;

use App\Models\User;
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
            Docente::updateOrCreate([
                'identificacion' => $row->ide,
            ],[
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'email' => $row['email'],
                'estado' => $row['estado'],
                'password' => Hash::make($data['identificacion'])
            ]);

            Asignacion::updateOrCreate([
                'identificacion' => $row->ide,
                'año' => $row->año,
                'periodo' => $row->periodo
            ],[
                'jefe' => $row['jefe'],
            ]);

            Jefes_por_periodo::updateOrCreate([
                'identificacion' => $row['identificacion'],
                'año' => $row['año'],
                'periodo' => $row['periodo']
            ],[
                'jefe' => $row['jefe'],
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
