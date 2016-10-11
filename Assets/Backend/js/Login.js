
 
 $("#inputPassword").keypress(function(e) {
    if(e.which == 13) {
    	Check_Login();
    }
});

$('#login-form').delegate('button.btn-lg', 'click', function() {
	 Check_Login();
});


function Check_Login(){ 
	if(($("#inputUsername").val().length > 0)&& ($("#inputPassword").val().length > 0) ) { 
		$.ajax({
			url:  backend_url+'Login/check_auth',
			data: {inputUsername:$("#inputUsername").val(),inputPassword:$("#inputPassword").val() },
			type: "POST",
			cache:false,
			success: function (data) {
				if(data == "true"){
					$('#result_js').text("ยินดีต้อนรับเข้าสู่ระบบ");
					window.setTimeout('location.reload()', 1500);
				}else {
					$('#result_js').text("ผิดพลาด กรุณาตรวจสอบการเช้าสู่ระบบอีกครั้ง");
					$("#inputPassword").val("");
					$("#inputPassword").focus();
				}
			}
		});
	}else{ 
		$('#result_js').text("ผิดพลาด กรุณาตรวจสอบการเช้าสู่ระบบอีกครั้ง");
	}
}
