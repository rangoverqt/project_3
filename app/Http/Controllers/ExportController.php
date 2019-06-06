<?php

namespace App\Http\Controllers;

use App\hocvien;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportController extends Controller implements FromCollection, WithHeadings
{
    //
    use Exportable;
    protected $idlop;
    public function __construct($idlop)
    {
        $this->idlop = $idlop;
    }

    public function collection()
    {
        $test = $this->idlop;
        $hocvien = hocvien::where('id_lop','=',$test)->get();
        $no = 1;
        foreach ($hocvien as $row) {
            $hocvien_array[] = array(
                '0' => $no++,
                '1' => $row->hoten,
                '2' => $row->mssv,
                '3' => $row->sdt,
                '4' => $row->email,
                '5' => $row->ngay_sinh,
                '6' => $row->chucvu->ten_chucvu,
            );
        }

        return (collect($hocvien_array));
    }
    public function headings(): array
    {
        return [
            'STT',
            'Họ tên',
            'MSSV',
            'SĐT',
            'Email',
            'Ngày sinh',
            'Chức vụ',
        ];
    }
}
