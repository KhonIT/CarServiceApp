$(document).ready(function(){
	Get_All_Member();
	Get_All_Level();
	$(".member-add").click(function (event) {
		$("#modal_member").modal();
		$("#tb_m_id").val('0');
	});
});

function Get_All_Level(){
	$.ajax({
		url: backend_url+'Level/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data) {
			$("#dd_Level").find('option').remove().end();
			$.each(data, function(idx, obj) {
				$("#dd_Level").append('<option value='+obj.l_id+'>'+obj.l_name+'</option>');
			});
		}
	});
}

function Get_All_Member(){
	$.ajax({
		url: backend_url+'Member/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#tbody_member").text("");
				var i = 1;
				var html= "";
				$.each(data, function(idx, obj) {

					html= '<tr><td>'+i+'</td>';
					html+= '<td> '+obj.m_name+' </td>';
					html+= '<td> '+obj.m_email+' </td>';
					html+= '<td> '+obj.l_name+' </td>';
					html+= '<td align="center"><span class="glyphicon glyphicon-option-horizontal member-edit icon" id='+obj.m_id+'></span></td>';
					html+= '<td align="center"><span class="glyphicon glyphicon-remove member-remove icon" id='+obj.m_id+'></span></td></tr>';
					$("#tbody_member").append(html);
					i++;
				});
			}
	});
}


$('#modal_member').delegate('span.member-save', 'click', function() {
	$.ajax({
		url:  backend_url+'Member/Edit',
		data: {m_id:$("#tb_m_id").val(),m_name:$("#tb_m_name").val(),m_email:$("#tb_m_email").val(),l_id:$('#dd_Level :selected').val()},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data = "true"){
				alert("บันทึ่กขึ้อมูลเรียบร้อย");
				$("#tb_m_name").val("");
				$("#tb_m_email").val("");
				$("#tb_m_id").val("");
				$('#modal_member').modal('toggle');
				Get_All_Member();
			}
		}
	});
});

$('#tbody_member').delegate('span.member-edit', 'click', function() {

	$.ajax({
		url: backend_url+'Member/Get_By_ID',
		data: {m_id:$.trim(event.target.id)},
		cache:false,
		type: "POST",
		dataType: "json",
		success: function (data)
			{
				$("#modal_member").modal();
				$("#tb_m_id").val(data.m_id);
				$("#tb_m_name").val(data.m_name);
				$("#tb_m_email").val(data.m_email);
				$("#dd_Level").val(data.l_id);
			}
	});
});

$('#tbody_member').delegate('span.member-remove', 'click', function() {
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$.ajax({
			  url:  backend_url+'Member/Delete',
			  data: {m_id:$.trim(event.target.id)},
			   type: "post",
			  cache:false,
			  success: function (data)
			  {
				 if(data = "true")   Get_All_Member();
			  }
		});
	}
});
