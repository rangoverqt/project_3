<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/12/18
 * Time: 4:17 PM
 */
?>
@include('layout/header')
@if(count($errors)>0)
    <div class="alert alert-danger">
        @foreach($errors -> all() as $err)
            {{$err}} <br>
        @endforeach
    </div>
@endif
<div class="container">
    <div class="turnback">
        <a href="/doan3/public/hocvien/loptruong/hoatdong/{{$namhoc -> id_lop}}">Trở về</a>
    </div>
<div class="tt_hk">
    <h4>Trang thêm thành tích</h4>
    <h5>Hoạt động: {{$hd -> ten_hoatdong}}</h5>
    <h5>Năm học: {{$namhoc -> hocky -> namhoc -> namhoc}}</h5>
    <h5>Học kỳ: {{$namhoc -> hocky -> hocky}}</h5>
    <h5>Lớp: {{$namhoc -> lop -> ten_lop}}</h5>
</div>
    <div class="form-group">
        <form action="/doan3/public/hocvien/loptruong/themthanhtich/{{$hd -> id}}" method="post" name="add_name" id="add_name">
            @csrf
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered" id="dynamic_field">
                    <tr>

                        <td>
                            <h5>Chọn học viên</h5>
                            <select name="hocvien[]" class="form-control name_list">
                                @foreach($hocvien as $hv)
                                    <option value="{{$hv -> hocvien -> id}}">{{$hv -> hocvien -> hoten}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <h5>Chọn thành tích</h5>
                            <select name="thanhtich[]" class="form-control name_list">
                                <option value="1">Hạng nhất</option>
                                <option value="2">Hạng hai</option>
                                <option value="3">Hạng ba</option>
                                <option value="4">Hạng khuyến khích</option>
                            </select>
                        </td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Thêm" />
            </div>

        </form>
    </div>
</div>
<div class="container-fluid footer">
    <h5>Copyright &copy; 2015</h5>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var postURL = "<?php echo url('themthanhtich',$hd -> id); ?>";
        var i=1;
        var test = '<?php foreach($hocvien as $hv)
        {echo '<option value="'.$hv -> hocvien -> id.'">'.$hv -> hocvien -> hoten.'</option>';}
        ?>';
        var test2 = '<?php echo $hd -> id?>';
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+ i +'" class="dynamic-added">' +
                '<td><select name="hocvien[]" class="form-control name_list">' +
                test +
                '</select></td>' +
                '<td><select name="thanhtich[]" class="form-control name_list">' +
                '<option value="1">Hạng nhất</option>' +
                '<option value="2">Hạng hai</option>' +
                '<option value="3">Hạng ba</option>' +
                '<option value="4">Hạng khuyến khích</option>' +
                '</select></td>' +
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });})
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[hocvien="csrf-token"]').attr('content')
    //         }
    //     });
    //     $('#submit').click(function(){
    //         $.ajax({
    //             url:postURL,
    //             method:"POST",
    //             data:$('#add_name').serialize(),
    //             type:'json',
    //             success:function(data)
    //             {
    //                 if(data.error){
    //                     printErrorMsg(data.error);
    //                 }else{
    //                     i=1;
    //                     $('.dynamic-added').remove();
    //                     $('#add_name')[0].reset();
    //                     $(".print-success-msg").find("ul").html('');
    //                     $(".print-success-msg").css('display','block');
    //                     $(".print-error-msg").css('display','none');
    //                     $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
    //                 }
    //             }
    //         });
    //     });
    //
    //
    //     function printErrorMsg (msg) {
    //         $(".print-error-msg").find("ul").html('');
    //         $(".print-error-msg").css('display','block');
    //         $(".print-success-msg").css('display','none');
    //         $.each( msg, function( key, value ) {
    //             $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    //         });
    //     }
    // });
</script>