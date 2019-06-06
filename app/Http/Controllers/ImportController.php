<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\hocvien;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class ImportController extends Controller implements ToCollection,WithHeadingRow
{
    //
    use Importable;
    protected $idlop;
    public function __construct($idlop)
    {
        $this->idlop = $idlop;
    }
    public function collection(Collection $rows)
    {
        $test = $this->idlop;
            if (hocvien::where('id_lop','=',$test)){
                foreach ($rows as $row) {
                    if (hocvien::where('mssv','=',$row['mssv'])->count()>0) {
                        if ($row['chuc_vu'] == 'Lớp trưởng' || $row['chuc_vu'] == 'lớp trưởng') {
                            $hocvien_array[] = hocvien::where('id_lop', '=', $test)->where('mssv', '=', $row['mssv'])->update([
                                'hoten' => $row['ho_ten'],
                                'mssv' => $row['mssv'],
                                'sdt' => $row['sdt'],
                                'email' => $row['email'],
                                'ngay_sinh' => $row['ngay_sinh'],
                                'id_chucvu' => 2,
                                'id_lop' => $test
                            ]);
                        } elseif ($row['chuc_vu'] == 'Sinh viên' || $row['chuc_vu'] == 'sinh viên') {
                            $hocvien_array[] = hocvien::where('id_lop', '=', $test)->where('mssv', '=', $row['mssv'])->update([
                                'hoten' => $row['ho_ten'],
                                'mssv' => $row['mssv'],
                                'sdt' => $row['sdt'],
                                'email' => $row['email'],
                                'ngay_sinh' => $row['ngay_sinh'],
                                'id_chucvu' => 1,
                                'id_lop' => $test
                            ]);
                        }
                    }
                    else{
                        if($row['chuc_vu'] == 'Lớp trưởng' || $row['chuc_vu'] == 'lớp trưởng'){
                                $id_hocvien = hocvien::orderBy('id', 'desc')->first()->id;
                                $mssv_hv = hocvien::orderBy('mssv', 'desc')->first()->mssv;
                            $hocvien_them[] = hocvien::where('id_lop','=',$test)->insert([
                                'id' => $id_hocvien + 1,
                                'hoten' => $row['ho_ten'],
                                'password' => Hash::make('123'),
                                'mssv' => $mssv_hv + 1,
                                'sdt' => $row['sdt'],
                                'email' => $row['email'],
                                'ngay_sinh' => $row['ngay_sinh'],
                                'id_chucvu' => 2,
                                'id_lop' => $test
                            ]);
                        }
                        elseif($row['chuc_vu'] == 'Sinh viên' || $row['chuc_vu'] == 'sinh viên'){
                            $id_hocvien = hocvien::orderBy('id', 'desc')->first()->id;
                            $mssv_hv = hocvien::orderBy('mssv', 'desc')->first()->mssv;
                            $hocvien_them[] = hocvien::where('id_lop','=',$test)->insert([
                                'id' => $id_hocvien + 1,
                                'hoten' => $row['ho_ten'],
                                'password' => Hash::make('123'),
                                'mssv' => $mssv_hv + 1,
                                'sdt' => $row['sdt'],
                                'email' => $row['email'],
                                'ngay_sinh' => $row['ngay_sinh'],
                                'id_chucvu' => 1,
                                'id_lop' => $test
                            ]);
                        }
                    }
            }
        }
//        var_dump($hocvien_array);
//        dd($hocvien_array);
    }
}
