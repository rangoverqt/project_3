<?php

namespace App\Imports;

use App\hocvien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class hocvienImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new hocvien([
            //
            'hoten' => $row[1],
            'mssv' => $row[2],
            'sdt' => $row[3],
            'email' => $row[4],
            'ngay_sinh' => $row[5]
        ]);
    }
}
