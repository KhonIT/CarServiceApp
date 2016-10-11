$(document).ready(function(){
	Get_All_Level();
	$(".level-add").click(function (event) {
		$("#modal_level_add").modal();
	});
});

function Get_All_Level(){
	$.ajax({
		url: backend_url+'Level/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#tbody_level").text("");
				$("#dd_Level_add").find('option').remove().end();
				$("#dd_Level_edit").find('option').remove().end();
				var i = 1;
				$.each(data, function(idx, obj) {
					$("#tbody_level").append('<tr><td>'+i+'</td><td>'+obj.l_name+'</td><td>'+obj.l_parent_name+'</td><td align="center"><span class="glyphicon glyphicon-option-horizontal level-edit icon " id='+obj.l_id+'></span></td><td align="center"><span class="glyphicon glyphicon-option-horizontal permission-edit icon " id='+obj.l_id+'></span></td><td align="center"><span class=" glyphicon glyphicon-remove level-remove icon " id='+obj.l_id+'></span></td></tr>');
						i++;
						$("#dd_Level_add").append('<option value='+obj.l_id+'>'+obj.l_name+'</option>');
						$("#dd_Level_edit").append('<option value='+obj.l_id+'>'+obj.l_name+'</option>');
				});
			}
	});
}





$('#modal_level_add').delegate('span.level-add', 'click', function() {
	$.ajax({
		url:  backend_url+'Level/Add',
		data: {l_name:$('#tb_l_name_add').val(),l_parent_id:$('#dd_Level_add :selected').val()},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data = "true"){
				alert("บันทึ่กขึ้อมูลเรียบร้อย");
				$('#tb_l_name_add').val("");
				$('#modal_level_add').modal('toggle');
					Get_All_Level();
				}
			}
	});
});

$('#modal_level_edit').delegate('button.close', 'click', function() {
	$.ajax({
		url: backend_url+'Level/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#dd_Level_edit").find('option').remove().end();

				$.each(data, function(idx, obj) {
						$("#dd_Level_edit").append('<option value='+obj.l_id+'>'+obj.l_name+'</option>');
				});
			}
	});
});

$('#tbody_level').delegate('span.level-edit', 'click', function() {
				$.ajax({
					url: backend_url+'Level/Get_By_ID',
					data: {l_id:$.trim(event.target.id)},
					cache:false,
					type: "POST",
					dataType: "json",
					success: function (data)
						{
							$('#dd_Level_edit option[value="'+data.l_id+'"]').remove();
							$("#modal_level_edit").modal();
							$("#tb_l_id_edit").val(data.l_id);
							$("#tb_l_name_edit").val(data.l_name);
							$("#dd_Level_edit").val(data.l_parent_id);
							$('#dd_Level_edit option[value="'+data.l_id+'"]').remove();
						}
				});

});


$('#tbody_level').delegate('span.permission-edit', 'click', function() {
	var l_id = $.trim(event.target.id);
	$.ajax({
		url: backend_url+'Permission/Get_By_ID',
		data: {l_id:l_id},
		cache:false,
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#modal_permission_edit").modal();
				$("#tbody_permission").text("");
				var i = 1;var html= "";
				$.each(data, function(idx, obj) {
					html+= '<tr><td align="center">'+i+'</td>';
					html+= '<td> '+obj.l_name+' </td>';
					html+= '<td>'+obj.parent_menu+':'+obj.menu_name+' </td>';
					if(obj.is_edit == "1"){
						html+= '<td id="'+obj.permission_id+'" align="center" ><input type="checkbox" id="menuid_'+obj.menu_id+'" checked="checked" value="'+obj.menu_id+'" " /> </td></tr>';
					}else{

						html+= '<td id="'+obj.permission_id+'" align="center"><input type="checkbox" id="menuid_'+obj.menu_id+'" value="'+obj.menu_id+'"  " /> </td></tr>';
					}
					i++;
				});
				html+= '<tr><td align="center" colspan="4"><span class="glyphicon glyphicon-floppy-save permission-save icon "  id="'+ l_id +'"></span></td></tr>';
			 	$("#tbody_permission").append(html);
			}
	});

});


$('#tbody_permission').delegate('span.permission-save', 'click', function() {
	var  jsonObj = [];
	$('input:checkbox[id^="menuid_"]').each(function(){
			//alert($(this).val()+":"+$(this).prop("checked")+":"+$("#"+$(this).attr("id")).parent().attr("id"));
	       	data = {}
	        data["l_id"] = $.trim(event.target.id);
	        data["menu_id"] = $(this).val();
	        data["is_edit"] = $(this).prop("checked");
	        data["permission_id"] = $("#"+$(this).attr("id")).parent().attr("id");

	        jsonObj.push(data);

	});
	var jsonpost = JSON.stringify(jsonObj)
	//alert(jsonpost);
	$.ajax({
		url:  backend_url+'Permission/Edit',
		data: {'jsonObj': jsonpost},
		type: "POST",
		cache:false,
		success: function (data) {
			$('#modal_permission_edit').modal('toggle');
			Get_All_Level();
		}
	});
});



$('#modal_level_edit').delegate('span.level-edit-save', 'click', function() {
	$.ajax({
		url:  backend_url+'Level/Edit',
		data: {l_id:$("#tb_l_id_edit").val(),l_name:$("#tb_l_name_edit").val(),l_parent_id:$('#dd_Level_edit :selected').val()},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data = "true"){
				$("#tb_l_id_edit").val("");
				$("#tb_l_name_edit").val("");
				$('#modal_level_edit').modal('toggle');
				Get_All_Level();
			}
		}
	});
});


$('#tbody_level').delegate('span.level-remove', 'click', function() {
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$.ajax({
			  url:  backend_url+'Level/Delete',
			  data: {l_id:$.trim(event.target.id)},
			   type: "post",
			  cache:false,
			  success: function (data)
			  {
				 if(data = "true")   Get_All_Level();
			  }
		});
	}
});
