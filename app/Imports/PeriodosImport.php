<?php

namespace App\Imports;

use App\Models\Periodo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeriodosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Periodo([
            'periodo'     => $row['periodo'],
            'estado'    => $row['estado'],
         ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
