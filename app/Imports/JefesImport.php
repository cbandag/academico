<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Periodo;
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
        $periodoActual=Periodo::where('estado','=','ACTIVO')->first();

        foreach ($rows as $row)
        {
            $user = User::updateOrCreate([
                'identificacion' => $row['identificacion'],
            ],[
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'email' => strtolower($row['email']),
                'password' => Hash::make($row['identificacion']),
            ])->assignRole('jefe');



            $user->Jefes_por_periodo()->updateOrCreate([
            //Jefes_por_periodo::updateOrCreate([
                'identificacion_jefe' => $row['identificacion'],
                'año' => $periodoActual->año,
                'periodo' => $periodoActual->periodo
            ]);

        }
    }
    public function headingRow()
    {
        return 1;
    }

}
