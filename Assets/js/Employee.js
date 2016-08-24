$(document).ready(function(){
	Get_All_Employee();
	Get_All_Level();
	$(".employee-add").click(function (event) {
		$("#tb_e_id").val("0");
		$("#tb_name").val("");
		$("#tb_e_nickname").val("");
		$("#tb_e_username").val("");
		$("#tb_e_password").val("");
		$("#modal_data").modal();
	});
});

function Get_All_Level(){
	$.ajax({
		url: bas_url+'backend/Level/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data) {
			$("#dd_Level").find('option').remove().end();
			$.each(data, function(idx, obj) {
				if(obj.l_id != '1'){
					$("#dd_Level").append('<option value='+obj.l_id+'>'+obj.l_name+'</option>');
				}
			});
		}
	});
}

function Get_All_Employee(){
	$.ajax({
		url: bas_url+'backend/Employee/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#tbody_data").text("");
				var i = 1;
				var html= "";
				$.each(data, function(idx, obj) {

					html= '<tr><td>'+i+'</td>';
					html+= '<td> '+obj.name+' </td>';
					html+= '<td> '+obj.nickname+' </td>';
					html+= '<td> '+obj.l_name+' </td>';
					html+= '<td align="center"><span class="glyphicon glyphicon-option-horizontal data-edit icon" id='+obj.e_id+'></span></td>';
					html+= '<td align="center"><span class="glyphicon glyphicon-remove data-remove icon" id='+obj.e_id+'></span></td></tr>';
					$("#tbody_data").append(html);
					i++;
				});
			}
	});
}


$('#modal_data').delegate('span.data-save', 'click', function() {
	$.ajax({
		url:  bas_url+'backend/Employee/Edit',
		data: {e_id:$("#tb_e_id").val(),name:$("#tb_name").val(),e_nickname:$("#tb_e_nickname").val(),e_username:$("#tb_e_username").val(),e_password:$("#tb_e_password").val(),l_id:$('#dd_Level :selected').val()},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data = "true"){
				alert("บันทึ่กขึ้อมูลเรียบร้อย");
				$("#tb_e_id").val("");
				$("#tb_name").val("");
				$("#tb_e_nickname").val("");
				$("#tb_e_username").val("");
				$("#tb_e_password").val("");
				$('#modal_data').modal('toggle');
				Get_All_Employee();
			}
		}
	});
});

$('#tbody_data').delegate('span.data-edit', 'click', function() {

	$.ajax({
		url: bas_url+'backend/Employee/Get_By_ID',
		data: {e_id:$.trim(event.target.id)},
		cache:false,
		type: "POST",
		dataType: "json",
		success: function (data)
			{
				$("#tb_e_id").val(data.e_id);
				$("#tb_name").val(data.name);
				$("#tb_e_nickname").val(data.nickname);
				$("#tb_e_username").val(data.e_username);
				$("#tb_e_password").val(data.e_password);
				$("#dd_Level").val(data.l_id);
				$("#modal_data").modal();
			}
	});
});

$('#tbody_data').delegate('span.data-remove', 'click', function() {
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$.ajax({
			  url:  bas_url+'backend/Employee/Delete',
			  data: {e_id:$.trim(event.target.id)},
			   type: "post",
			  cache:false,
			  success: function (data)
			  {
				 if(data = "true")   Get_All_Employee();
			  }
		});
	}
});
