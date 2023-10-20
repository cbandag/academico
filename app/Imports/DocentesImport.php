<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Asignacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;



class DocentesImport implements ToCollection, WithHeadingRow //WithValidation
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
                'password' => Hash::make($row['identificacion']),
            ])->assignRole('docente');

            //$id_jefe =User::find($row['jefe']);
            

            if( null !== User::find($row['jefe']) ){
                //$jefe = $row['jefe'];
                Asignacion::updateOrCreate([
                //$user->Asignacion()->updateOrCreate([
                    'identificacion_docente' => $row['identificacion'],
                    'año' => '2023',
                    'periodo' => '2'
                ],[
                    'identificacion_jefe' => $row['jefe'],
                    'horas_dedicacion' => $row['horas_dedicacion']/*=='Tiempo Completo'?'40':'20' */,
                    'estado' => 'PENDIENTE'
                ]);
            }

        }

    }
}
/*
    public function rules(): array
    {
        return [
            '1' => Rule::in(['patrick@maatwebsite.nl']),

             // Above is alias for as it always validates in batches
             '*.1' => Rule::in(['patrick@maatwebsite.nl']),

             // Can also use callback validation rules
             '0' => function($attribute, $value, $onFailure) {
                  if ($value !== 'Patrick Brouwers') {
                       $onFailure('Name is not Patrick Brouwers');
                  }
              }
        ];
    }

*/
