<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Periodo;
use App\Models\Asignacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;



class DocentesImport implements ToCollection, WithHeadingRow //WithValidation
{

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
            ])->assignRole('docente');

            //$id_jefe =User::find($row['jefe']);


            if(User::where('identificacion',$row['jefe'])->first() ){
                $jefe = $row['jefe'];
            }else{
                $jefe = null;
            }

            Asignacion::updateOrCreate([
            //$user->Asignacion()->updateOrCreate([
                'identificacion_docente' => $row['identificacion'],
                'año' => $periodoActual->año,
                'periodo' => $periodoActual->periodo
            ],[
                'identificacion_jefe' => $jefe,
                'horas_dedicacion' => $row['horas_dedicacion']/*=='Tiempo Completo'?'40':'20' */,
                'estado' => 'PENDIENTE'
            ]);

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
