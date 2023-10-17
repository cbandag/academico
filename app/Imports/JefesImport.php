<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Jefes_por_periodo;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class JefesImport implements ToCollection, WithHeadingRow
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
            $user = User::updateOrCreate([
                'identificacion' => $row['identificacion'],
            ],[
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'email' => $row['email'],
                //'estado' => $row['estado'],
                'password' => Hash::make($row['identificacion']),
            ])->assignRole('jefe');




            $user->Jefes_por_periodo()->updateOrCreate([
                'identificacion' => $row['identificacion'],
                'año' => $row['year'],
                'periodo' => $row['periodo']
            ],[

            ]);

        }
    }
    public function headingRow()
    {
        return 1;
    }

}
