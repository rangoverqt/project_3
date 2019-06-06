// Kiểm tra xem người dùng có nhập vào tên lớp hay chưa
var tenlop = document.getElementById('tenlop');
tenlop.oninvalid = function(event) {
    event.target.setCustomValidity('Vui lòng nhập tên lớp vào');
};
//Kiểm tra số lượng lớp
var input = document.getElementById('soluong');
input.oninvalid = function(event) {
    event.target.setCustomValidity('Vui lòng nhập số lượng của lớp');
};
var input = document.getElementById('nganh');
input.oninvalid = function(event) {
    event.target.setCustomValidity('Vui lòng nhập tên ngành');
};
$('#themlop').click(function(event) {
	var nganh = $('#nganh').val();
	var namhoc_bd = $('#namhoc_bd').val();
	var namhoc_kt = $('#namhoc_kt').val();
	if (nganh == 0 || namhoc_bd == 0 || namhoc_kt == 0) {
		alert("Bạn chưa chọn ngành hoặc năm học!"); 
		return false;
	}
	else{
		return true;
	}
});


// var input = document.getElementById('namhoc');
// input.oninvalid = function(event) {
//     event.target.setCustomValidity('Vui lòng nhập chọn năm học');
// };




