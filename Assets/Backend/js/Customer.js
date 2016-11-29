
var app = angular.module('App', []);
app.controller('customerController', function($scope, $http)  {

$scope.customers = []; //declare an empty array
$http.get(backend_url+'Customer/Get_All').success(function(response){
		$scope.customers = response;  //ajax request to fetch data into $scope.data
}). error(function (err) {
					 $log(err);
	 });


$scope.displayData=function(){
 	$http.get(backend_url+'Customer/Get_All').success(function(response){
 			$scope.customers = response;  //ajax request to fetch data into $scope.data
 	}). error(function (err) {
             $log(err);
     })
}
$scope.sort = function(keyname){
	$scope.sortKey = keyname;   //set the sortKey to the param passed
	$scope.reverse = !$scope.reverse; //if true make it false and vice versa
}

$scope.delcus=function(cusid){
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$http.post(backend_url+'Customer/Delete',{'id':cusid})
		.success(function(data){
						 if(data = "true"){

							 					alert("บันทึ่กขึ้อมูลเรียบร้อย");
						 }
				$scope.displayData();
		}) 
	}
}

$scope.sort = function(keyname){
	$scope.sortKey = keyname;   //set the sortKey to the param passed
	$scope.reverse = !$scope.reverse; //if true make it false and vice versa
}

});





$(document).ready(function(){
	//Get_All_Customer();
	$(".add-data").click(function (event) {
		$("#tb_id").val("0");
		$("#tb_cus_name").val("");
		$("#tb_cus_tel").val("");
		$("#tb_cus_car_regis_number").val("");
		$("#tb_cus_car_brand").val("");
		$("#tb_cus_car_model").val("");
		$("#tb_cus_car_color").val("");
		$("#modal_data").modal();
	});

	});



function Get_All_Customer(){
$scope.displayData();
}


$('#tbody_list').delegate('span.edit-data', 'click', function() {
			$.ajax({
					url: backend_url+'Customer/Get_By_ID',
					data: {id:$.trim(event.target.id)},
					cache:false,
					type: "POST",
					dataType: "json",
					success: function (data)
						{
							$("#tb_id").val(data.id);
							$("#tb_cus_name").val(data.cus_name);
							$("#tb_cus_tel").val(data.cus_tel);
							$("#tb_cus_car_regis_number").val(data.cus_car_regis_number);
							$("#tb_cus_car_brand").val(data.cus_car_brand);
							$("#tb_cus_car_model").val(data.cus_car_model);
							$("#tb_cus_car_color").val(data.cus_car_color);
							$("#modal_data").modal();
						}
				});
});

$('#modal_data').delegate('span.save-data', 'click', function() {
	$.ajax({
		url:  backend_url+'Customer/Edit',
		data: {id:$("#tb_id").val(),cus_name:$('#tb_cus_name').val(),cus_tel:$('#tb_cus_tel').val(),cus_car_regis_number:$('#tb_cus_car_regis_number').val(),cus_car_brand:$('#tb_cus_car_brand').val(),cus_car_model:$('#tb_cus_car_model').val(),cus_car_color:$('#tb_cus_car_color').val()},
		type: "POST",
		cache:false,
 		async: false,
		success: function (data) {
			if(data == "false"){

			}else{
					alert("บันทึ่กขึ้อมูลเรียบร้อย");
					$("#tb_id").val("0");
					$("#tb_cus_name").val("");
					$("#tb_cus_tel").val("");
					$("#tb_cus_car_regis_number").val("");
					$("#tb_cus_car_brand").val("");
					$("#tb_cus_car_model").val("");
					$("#tb_cus_car_color").val("");
					$('#modal_data').modal('toggle');
						Get_All_Customer();
				}
			}
	});
});
