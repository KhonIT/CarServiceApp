$(document).ready(function(){
	Get_All_service();
	$(".add-data").click(function (event) {      
		$("#tb_id").val("0");  
		$("#tb_name").val(""); 
		$('#tb_price').val("");
		$("#modal_popup").modal(); 
	});  
});  

 
function Get_All_service(){
	$.ajax({
		url: bas_url+'Customer_Service/Get_All',
		data: {},
		dataType: "json",
		type: "POST", 
		dataFilter: function (data) { return data; },
		success: function (data) 
			{
				$("#tbody_list").text("");
				var i = 1;
				$.each(data, function(idx, obj) {  
					$("#tbody_list").append('<tr><td>'+i+'</td><td>'+obj.cus_name+'</td><td>'+obj.cus_tel+'</td><td>'+obj.cus_car_regis_number+'-'+obj.cus_car_brand+'-'+obj.cus_car_model+'-'+obj.cus_car_color+'</td><td>'+obj.created_date+'</td><td align="center"><span class="glyphicon glyphicon-option-horizontal detail-data icon " id='+obj.id+'></span></td><td align="center"><span class="glyphicon glyphicon-option-horizontal edit-data icon " id='+obj.id+'></span></td><td align="center"><span class=" glyphicon glyphicon-remove remove-data icon " id='+obj.service_id+'></span></td></tr>'); 
						i++;
					});   
			}
	});
} 
 
 $('#tbody_list').delegate('span.detail-data', 'click', function() {
	 $.ajax({
		url: bas_url+'Customer_Service/Get_OrdersDetails_By_ID', 
		data: { id:$.trim(event.target.id)},
		cache:false, 
		type: "POST",
		dataType: "json",
		success: function (data) 
		{     
			$("#tbody_details_service_list").text(""); 
			var i = 1;
			var sum = parseFloat("0.00");
			$.each(data, function(idx, obj) {  
				$("#tbody_details_service_list").append('<tr><td align="center">'+i+'</td><td align="left">'+obj.service_name+'</td><td align="center">'+obj.price+'</td></tr>'); 
				sum+= parseFloat(obj.price);
				i++;
			}); 
			$("#tbody_details_service_list").append('<tr><td align="center" colspan="2">รวม</td><td>'+sum.toFixed(2)+'</td></tr>'); 
			$("#modal_popup_detail_order").modal();  
		}
		});  
});  
 
$('#tbody_list').delegate('span.edit-data', 'click', function() {		
							$.ajax({
					url: bas_url+'Customer_Service/Get_By_ID', 
					data: { id:$.trim(event.target.id)},
					cache:false, 
					type: "POST",
					dataType: "json",
					success: function (data) 
						{      
							$("#tb_id").val(data.service_id); 
							$("#tb_name").val(data.service_name);   
							$('#tb_price').val(data.price);
							$("#modal_popup").modal();  
						}
				});  
});   		 

$('#modal_popup').delegate('span.save-data', 'click', function() {		
	$.ajax({
		url:  bas_url+'Customer_Service/Edit',
		data: {id:$("#tb_id").val(),name:$('#tb_name').val(),price:$('#tb_price').val()},
		type: "POST",
		cache:false, 
		success: function (data) { 
			if(data = "true"){
				alert("บันทึ่กขึ้อมูลเรียบร้อย");
				$("#tb_id").val("");  
				$("#tb_name").val(""); 
				$('#tb_price').val("");
				$('#modal_popup').modal('toggle');
					Get_All_service();
				}   
			}
	});
});  		


 
$('#tbody_list').delegate('span.remove-data', 'click', function() {
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$.ajax({
			  url:  bas_url+'Customer_Service/Delete',
			  data: {id:$.trim(event.target.id)},                      
			   type: "post",
			  cache:false, 
			  success: function (data) 
			  {
				 if(data = "true")   Get_All_service();
			  }
		});
	} 
}); 