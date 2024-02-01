<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class LoadingDockExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return Excel::load(asset('template/template.xls'))->get();
    }

    public function headings(): array
    {
        return [
            'Column 1',
            'Column 2',
            // ...
        ];
    }
}
