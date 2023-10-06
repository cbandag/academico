<?php

namespace App\Exports;

use App\Models\Periodo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeriodosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Periodo::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'periodo',
            'estado',
        ];
    }
}
