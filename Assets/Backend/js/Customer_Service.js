$(document).ready(function(){
	Get_All_service();
	$(".add-data").click(function (event) {
		$("span.data-cus").text("");
		$('span.data-edit-cus').hide();
		$('span.data-add-cus').show();
		$('span.data-search-cus').show();
		$("#tb_cus_id").val("0");
		$("#tb_book_no").val("");
		$('#tb_number').val("");
		$('#tb_comment').val("");
		$('#tb_total').val("");
		$("#dd_pay_status").val("0");
		$("#modal_data").modal();
	});

	$("span.data-add-cus").click(function (event) {
		$("#tb_cus_id").val("0");
		$("#tb_cus_name").val("");
		$("#tb_cus_tel").val("");
		$("#tb_cus_car_regis_number").val("");
		$("#tb_cus_car_brand").val("");
		$("#tb_cus_car_model").val("");
		$("#tb_cus_car_color").val("");
		$("#modal_data_cus").modal();
	});



		$("span.data-search-cus").click(function (event) {
			$("#tb_cus_id").val("0");
			$("#tb_cus_tel_search").val("");
			$("#tb_cus_car_regis_number").val("");
			$("#modal_data_cus_search").modal();
		});

});

function Get_All_service(){
	$.ajax({
		url: backend_url+'Customer_Service/Get_All_UnPay',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#tbody_list").text("");
				var i = 1;
				$.each(data, function(idx, obj) {
					$("#tbody_list").append('<tr><td>'+i+'</td><td>'+obj.cus_name+'</td><td>'+obj.cus_tel+'</td><td>'+obj.cus_car_regis_number+'-'+obj.cus_car_brand+'-'+obj.cus_car_model+'-'+obj.cus_car_color+'</td><td>'+obj.created_date+'</td><td align="center"><span class="glyphicon glyphicon-option-horizontal edit-data icon " id='+obj.id+'></span></td><td align="center"><span class=" glyphicon glyphicon-remove remove-data icon " id='+obj.id+'></span></td></tr>');
						i++;
					});
			}
	});
}



$('#tbody_list').delegate('span.edit-data', 'click', function() {
			$.ajax({
					url: backend_url+'Customer_Service/Get_By_ID',
					data: { id:$.trim(event.target.id)},
					cache:false,
					type: "POST",
					dataType: "json",
					success: function (data)
						{
							$("span.data-cus").text("");
							$("span.data-cus").append('ชื่อ:'+data.cus_name+' <br>โทร:'+data.cus_tel+' <br>ทะเบียน:'+data.cus_car_regis_number+'<br>ยี่ห้อ:'+data.cus_car_brand+'<br>รุ่น:'+data.cus_car_model+'<br>สี:'+data.cus_car_color+'<br>');
							$("span.data-cus").attr('id','span-'+data.cus_id);
							$('span.data-edit-cus').show();
							$('span.data-add-cus').hide();
							$('span.data-search-cus').hide();
							$('span.data-edit-cus').attr('id',data.cus_id);
							$("#tb_id").val(data.id);
							$("#tb_book_no").val(data.book_no);
							$('#tb_number').val(data.number);
							$('#tb_comment').val(data.comment);
							$('#tb_total').val(data.total);
							$("#dd_pay_status").val(data.pay_status);

							$.ajax({
							 	url: backend_url+'Customer_Service/Get_OrdersDetails_By_ID',
							 	data: { id:data.id},
							 	cache:false,
							 	type: "POST",
							 	dataType: "json",
							 	success: function (result)
							 	{
									$("#table_order_detail").text("");
							 		var i = 1;
							 		var sum = parseFloat("0.00");
									var html ="";
							 		$.each(result, function(idx, obj) {
										if(obj.order_detail_id != "0"){
											html= '<tr><td align="center">'+i+'</td><td   ><input type="checkbox" id="service_'+obj.order_detail_id+'" checked="checked" value="'+obj.service_id+'"  /> '+obj.service_name+' : <input type="number" id="price-'+obj.service_id+'" value="'+obj.price+'"   /> </td> </tr>';
										}else{
											html= '<tr><td align="center">'+i+'</td><td  "><input type="checkbox" id="service_'+obj.order_detail_id+'" value="'+obj.service_id+'"   />'+obj.service_name+' : <input type="number" id="price-'+obj.service_id+'" value="'+obj.service_price+'"   /> </td> </tr>';
										}
									 $("#table_order_detail").append(html);
							 			sum+= parseFloat(obj.price);
							 			i++;
							 		});
							 	}
							});
							$("#modal_data").modal();
						}
				});

});

$('#modal_data').delegate('span.data-save', 'click', function() {
	var  jsonObj = [];
	var sum = parseFloat("0.00");
	$('input:checkbox[id^="service_"]').each(function(){
						data = [];
						data["order_id"] = $("#tb_id").val();
						data["order_detail_id"] =  $(this).attr('id').replace("service_", "");;
						data["service_id"] = $(this).val();
						data["is_show"] = $(this).prop("checked");
						data["price"] = $("#price-"+$(this).val()).val();
						if($(this).prop("checked")){
								sum+= parseFloat($("#price-"+$(this).val()).val());
						}
						jsonObj.push(data);

	});
	$('#tb_total').val(sum);
	var jsonpost = JSON.stringify(jsonObj);
	$.ajax({
		url:  backend_url+'Customer_Service/OrderDetailEdit',
		data: {'jsonObj': jsonpost},
		type: "POST",
		cache:false,
		success: function (data) {


				$.ajax({
					url:  backend_url+'Customer_Service/Edit',
					data: {id:$("#tb_id").val(),cus_id:	$("#tb_cus_id").val(),book_no:$('#tb_book_no').val(),number:$('#tb_number').val(),comment:$('#tb_comment').val(),total:$('#tb_total').val(),pay_status:$('#dd_pay_status :selected').val()},
					type: "POST",
					cache:false,
					success: function (result) {
						if(result = "true"){
							alert("บันทึ่กขึ้อมูลเรียบร้อย");
							$("#tb_id").val("0");
							$("#tb_cus_id").val("0");
							$('span.data-edit-cus').hide();
							$('span.data-add-cus').show();
							$("#tb_book_no").val("");
							$('#tb_number').val("");
							$('#tb_comment').val("");
							$('#tb_total').val("");
							$('#dd_pay_status').val("0");
							$('#modal_data').modal('toggle');

								Get_All_service();
							}
						}
				});
		}
	});

});

$('#tbody_list').delegate('span.remove-data', 'click', function() {
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$.ajax({
			  url:  backend_url+'Customer_Service/Delete',
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

$('#modal_data').delegate('span.data-edit-cus', 'click', function() {
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
							$("#modal_data_cus").modal();
						}
				});
});

$('#modal_data_cus').delegate('span.save-data', 'click', function() {
	$.ajax({
		url:  backend_url+'Customer/Edit',
		data: {id:$("#tb_cus_id").val(),cus_name:$('#tb_cus_name').val(),cus_tel:$('#tb_cus_tel').val(),cus_car_regis_number:$('#tb_cus_car_regis_number').val(),cus_car_brand:$('#tb_cus_car_brand').val(),cus_car_model:$('#tb_cus_car_model').val(),cus_car_color:$('#tb_cus_car_color').val()},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data == "false"){

			}else{
				alert("บันทึ่กขึ้อมูลเรียบร้อย");
				$("span.data-cus").text("");
				$("#tb_cus_id").val(data);
				$('span.data-edit-cus').attr('id',data);
				$("span.data-cus").append('ชื่อ:'+$('#tb_cus_name').val()+' <br>โทร:'+$('#tb_cus_tel').val()+' <br>ทะเบียน:'+$('#cus_car_regis_number').val()+'<br>ยี่ห้อ:'+$('#tb_cus_car_brand').val()+'<br>รุ่น:'+$('#tb_cus_car_model').val()+'<br>สี:'+$('#tb_cus_car_color').val()+'<br>');
				$("#tb_id").val("0");
				$('span.data-edit-cus').show();
				$('span.data-add-cus').hide();
				$("#tb_cus_name").val("");
				$("#tb_cus_tel").val("");
				$("#tb_cus_car_regis_number").val("");
				$("#tb_cus_car_brand").val("");
				$("#tb_cus_car_model").val("");
				$("#tb_cus_car_color").val("");
				$('#modal_data_cus').modal('toggle');
				}
			}
	});
});



 $('#modal_data_cus_search').delegate('span.search-data', 'click', function() {
	 $.ajax({
		url: backend_url+'Customer/Customer_Search',
		data: { cus_tel:$("#tb_cus_tel_search").val(),cus_car_regis_number:$("#tb_cus_car_regis_number_search").val()},
		cache:false,
		type: "POST",
		dataType: "json",
		success: function (data)
		{
			 $("#tbody_cus_list").text("");
			$.each(data, function(idx, obj) {
				var html = '<tr> <td>'+obj.cus_name+'</td>';
				 html += '<td>'+obj.cus_tel+'</td>';
				 html += '<td>'+obj.cus_car_regis_number+'</td>';
				 html += '<td>'+obj.cus_car_brand+'</td>';
				 html += '<td>'+obj.cus_car_model+'</td>';
				 html += '<td>'+obj.cus_car_color+'</td>' ;
				 html +='<td align="center"><span class="glyphicon glyphicon-share-alt choose-data icon " id='+obj.id+'></span></td></tr>';
				 $("#tbody_cus_list").append(html);
			});
		}
		});
});




 $('#modal_data_cus_search').delegate('span.choose-data', 'click', function() {

	 $.ajax({
 			url: backend_url+'Customer/Get_By_ID',
 			data: {id:$.trim(event.target.id)},
 			cache:false,
 			type: "POST",
 			dataType: "json",
 			success: function (data)
 				{
						$("span.data-cus").text("");
						$("#tb_id").val("0");
 				 		$('span.data-edit-cus').attr(data.id);
						$("#tb_cus_id").val(data.id);
						$("span.data-cus").append('ชื่อ:'+data.cus_name+' <br>โทร:'+data.cus_tel+' <br>ทะเบียน:'+data.cus_car_regis_number+'<br>ยี่ห้อ:'+data.cus_car_brand+'<br>รุ่น:'+data.cus_car_model+'<br>สี:'+data.cus_car_color+'<br>');
						$('span.data-edit-cus').show();
						$('span.data-add-cus').hide();
						$("#modal_data_cus_search").modal('toggle');
 				}
 		});
});
