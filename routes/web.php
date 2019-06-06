<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'hocvien'],function (){
    Route::get('dangnhap','hocvienController@getdangnhap');

    Route::post('dangnhap','hocvienController@postdangnhap');

    Route::get('dangxuat','hocvienController@getdangxuat');

    Route::group(['middleware'=>'hocvien:hocvien'],function (){

   Route::get('trangchu/{id}','hocvienController@gettrangchu');


   Route::group(['prefix'=>'bangdiem'],function (){

   Route::get('xemchitiet/{idbangdiem}','hocvienController@getxemchitiet');

   Route::get('tucham/{idhocvien}','hocvienController@getthemtucham');

   Route::post('tucham/{idhocvien}','hocvienController@postthemtucham');

   Route::get('xemtucham/{idhocvien}','hocvienController@xemtucham');

   Route::get('suatucham/{idhocvien}','hocvienController@suatucham');

   Route::post('suatucham/{idhocvien}','hocvienController@postsuatucham');

   Route::get('pdfview/{idhocvien}','PDFController@getPDF')->name('pdfdownload');

   Route::get('pdfview_chitiet/{idbangdiem}','PDFController@getPDF_chitiet')
       ->name('pdfdownload_chitiet');

   Route::get('yeucau/{idbangdiem}','hocvienController@getyeucau');

   Route::post('yeucau/{idbangdiem}','hocvienController@postyeucau');

   Route::get('xemyeucau/{idbangdiem}','hocvienController@getxemyeucau');

   Route::get('suayeucau/{idbangdiem}','hocvienController@getsuayeucau');

   Route::post('suayeucau/{idbangdiem}','hocvienController@postsuayeucau');

   });

   Route::group(['prefix'=>'loptruong'],function(){
      Route::get('trangchu/{id}','hocvienController@gettrangchu_lt');

      Route::get('danhsach/{idlop}','hocvienController@getdanhsachhv');

      Route::get('export/{idlop}','hocvienController@export_excel');

      Route::post('import/{idlop}','hocvienController@import_excel');

      Route::get('xoa/{id}','hocvienController@getxoa');

      Route::get('bangdiemlan1/{idlop}','hocvienController@getbangdiemlan1');

      Route::get('thongke/{idlop}','hocvienController@getthongke');

      Route::get('hoatdong/{idlop}','hocvienController@gethoatdong');

      Route::get('diemdanh/{idhoatdong}','hocvienController@getdiemdanh');

      Route::post('diemdanh/{idhoatdong}','hocvienController@postdiemdanh');

      Route::get('xemdiemdanh/{idhoatdong}','hocvienController@getxemdiemdanh');

      Route::get('suadiemdanh/{idhoatdong}','hocvienController@getsuadiemdanh');

      Route::get('themthanhtich/{idhoatdong}','hocvienController@getthemthanhtich');

      Route::post('themthanhtich/{idhoatdong}','hocvienController@postthemthanhtich');

      Route::get('suathanhtich/{idhoatdong}','hocvienController@getsuathanhtich');

      Route::get('bangdiem/{idlop}/duyet_lan1/{idbangdiem}','hocvienController@getduyetlan1');

      Route::post('bangdiem/{idlop}/duyet_lan1/{idbangdiem}','hocvienController@postduyetlan1');

      Route::get('bangdiem/{idlop}/xemchitiet_lan1/{idbangdiem}','hocvienController@xemchitiet_lan1');

      Route::get('bangdiem/{idlop}/suaduyet_lan1/{idbangdiem}','hocvienController@suaduyetlan1');

      Route::post('bangdiem/{idlop}/suaduyet_lan1/{idbangdiem}','hocvienController@postsuaduyetlan1');

      Route::get('bangdiem/{idlop}/duyetnhanh/{idbangdiem}','hocvienController@duyetnhanh');

      Route::get('cham_lan1/{idhocvien}','hocvienController@getchamlan1');

      Route::post('cham_lan1/{idhocvien}','hocvienController@postchamlan1');

      Route::get('xemcham_lan1/{idhocvien}','hocvienController@xemchamlan1');

      Route::get('suacham_lan1/{idhocvien}','hocvienController@getsuachamlan1');

      Route::post('suacham_lan1/{idhocvien}','hocvienController@postsuachamlan1');
   });
    });

   Route::group(['prefix'=>'ajax'],function (){
      Route::get('chonhocky/{idnamhoc}','ajaxController@gethocky');

      Route::get('chonhoatdong/{idhocky}','ajaxController@gethoatdong');
   });

});
Route::group(['prefix'=>'admin'],function (){
    Route::get('dangnhap','adminController@getdangnhap');

    Route::post('dangnhap','adminController@postdangnhap');

    Route::get('dangxuat','adminController@dangxuat');

    Route::group(['middleware'=>'admin:admin'],function (){

    Route::get('trangchu/{id}','adminController@gettrangchu');

    Route::group(['prefix'=>'quanly'],function (){
        Route::get('quanly_nguoidung/{id}','adminController@getquanly_nd');

        Route::get('nguoidung_lop/{idlop}','adminController@getndlop');

        Route::get('them_cvht/{idlop}','adminController@getthemcvht');

        Route::post('themmoi_cvht/{idlop}','adminController@postthemmoicvht');

        Route::post('chonlai_cvht/{idlop}','adminController@postchonlaicvht');

        Route::get('xoa_cvht/{idlop}','adminController@xoacvht');

        Route::get('sua_cvht/{idlop}','adminController@getsuacvht');

        Route::post('suatt_cvht/{idlop}','adminController@postsuacvht');

        Route::post('suachonlai_cvht/{idlop}','adminController@postsuachonlaicvht');

        Route::get('suatt_hv/{idhocvien}','adminController@getsuatthocvien');

        Route::post('suatt_hv/{idlop}','adminController@postsuatthocvien');

        Route::get('xoa_hv/{idhocvien}','adminController@xoahocvien');

        Route::get('them_hv/{idlop}','adminController@getthemhv');

        Route::post('them_hv/{idlop}','adminController@postthemhv');

        Route::get('phienphanquyen/{idadmin}','adminController@phienphanquyen');

        Route::get('chuyentrang/{idhocky}','adminController@chuyentrang');

        Route::get('phanquyen_chucnang/{idhocky}','adminController@phanquyen_chucnang');

        Route::post('phanquyen_chucnang/{idhocky}','adminController@postphanquyen_chucnang');

        Route::get('xoa_phienlamviec/{idadmin}','adminController@xoa_phienlamviec');

        Route::get('dongphanquyen_tucham/{idhocky}','adminController@dongphanquyen_tucham');

        Route::get('dongphanquyen_chamlan1/{idhocky}','adminController@dongphanquyen_chamlan1');

        Route::get('dongphanquyen_chamlan2/{idhocky}','adminController@dongphanquyen_chamlan2');

        Route::get('dongphanquyen_yeucau/{idhocky}','adminController@dongphanquyen_yeucau');

        Route::get('dongphanquyen_xemyeucau/{idhocky}','adminController@dongphanquyen_xemyeucau');
    });
    });
    Route::group(['prefix'=>'ajax'],function (){
        Route::get('chonnganh/{idkhoa}','ajaxController@getnganh');

        Route::get('chonlop/{idnganh}','ajaxController@getlop');

        Route::get('choncvht/{idcvht}','ajaxController@getcvht');

        Route::get('chonnamhoc/{idnamhoc}','ajaxController@chonhocky');

        Route::get('chonhocky/{idhocky}','ajaxController@xacnhan');
    });
});


Auth::routes();
Route::auth();
//Đăng nhập bí thư
Route::get('/bithulogin', 'bithuLoginController@getLogin')->name('bithulogin');
Route::post('/bithulogin', 'bithuLoginController@postLogin');
//Đăng nhập cvht
//Route::get('/covanlogin', function (){
//    return view('auth.login');
//});
//Route::post('/', 'UserController@check');

Route::get('/covanlogin', 'UserController@getlogin');
Route::post('/covanlogin', 'UserController@postlogin');
// Route::post('logout', function() {
//     return view('auth/login');
// });
//Phần bí thư
Route::group(['prefix' => 'bithu','middleware'=>'bithuLogin:bithu'], function() {
    Route::get('/', function() {
        return view('bithu.trangchubithu');
    });
    //Quản lý lớp
    Route::get('quanlylop','BithuController@lop');
    Route::get('themlop','BithuController@themlop');
    Route::post('insertlop','BithuController@insertlop');
    Route::get('sualop/{id}','BithuController@lopcansua');
    Route::post('updatelop/{id}','BithuController@updatelop');
    Route::get('xoalop/{id}','BithuController@xoalop');
    // Quản lý hoạt động
    Route::get('hoatdong','BithuController@hoatdong');
    Route::get('themhoatdong', function(){
        return view('bithu.themhoatdong');
    });
    Route::post('addhoatdong','BithuController@addhoatdong');
    Route::get('suahoatdong/{id}','BithuController@hoatdongcansua');
    Route::post('updatehoatdong/{id}','BithuController@updatehoatdong');
    Route::get('xoahoatdong/{id}','BithuController@xoahoatdong');
});
//Phần cố vấn học tập
Route::group(['prefix' => 'covan'], function() {
    Route::get('/','CovanController@showtrangchucovan');
    // Route::get('/', function() {
    //     return view('covan.trangcovan');
    // });
    Route::get('thongke','CovanController@showthongke');
    Route::get('thongkenamhoc/{id}','CovanController@shownamhoclopthongke');
    Route::get('ketquathongke/{idlop}/{idhocky}','CovanController@showketquathongke' );
    //Xem xét
    Route::get('yeucau/{id}','CovanController@showtrangyeucau');
    Route::get('yeucautheohocky/{idlop}/{idhocky}','CovanController@showdanhsachcacyeucau');
    Route::get('bangdiemchitiettheoyeucau/{id}','CovanController@showyeucauchitiet');

    //Duyệt lần 2
    Route::get('duyetlan2/{id}','CovanController@showdanhsachhocvien');
    Route::get('danhsachduyetlan2/{idlop}/{idhocky}','CovanController@showdanhsachchamlan2');
    Route::get('chitiet_hocvien_lan2/{id}','CovanController@showchitietdiemdachamlan1');
    Route::post('updatediemlan2','CovanController@updatediemlan2');
});

