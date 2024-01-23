<?php

namespace App\Imports;

use App\Models\Pt_56;
use Maatwebsite\Excel\Concerns\ToModel;

class Pt56Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pt_56([
            'dr_no' => $row[0],
            'trans_id' => $row[1],
            'palet_no' => $row[2],
            'barcode' => $row[3],
            'line_no' => $row[4],
            'loading_line' => $row[5],
            'assy_code' => $row[6],
            'pallet' => $row[7],
            'status' => $row[8]
        ]);
    }
}
