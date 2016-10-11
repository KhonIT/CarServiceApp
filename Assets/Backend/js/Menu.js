$(document).ready(function(){
	Get_All_menu();
	$(".menu-add").click(function (event) {
		$("#tb_menu_id").val("0");
		Get_parent_Menu("-");
		$("#tb_menu_name").val("");
		$('#tb_link_url').val("");
		$("#modal_menu").modal();
	});
}); 
function Get_All_menu(){
	$.ajax({
		url: backend_url+'Menu/Get_All',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#tbody_menu").text("");
				var i = 1;
				$.each(data, function(idx, obj) {
					$("#tbody_menu").append('<tr><td>'+i+'</td><td>'+obj.menu_name+'</td><td align="center"><span class="glyphicon glyphicon-option-horizontal menu-edit icon " id='+obj.menu_id+'></span></td><td align="center"><span class=" glyphicon glyphicon-remove menu-remove icon " id='+obj.menu_id+'></span></td></tr>');
						i++;
					});
			}
	});
}

function Get_parent_Menu(menu_id){
 $.ajax({
		url: backend_url+'Menu/Get_All',
		data: {},
		dataType: "json",
		type: "POST",

		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#dd_parent_menu").find('option').remove().end();
				$("#dd_parent_menu").append('<option value="0">เมนูหลัก</option>');
				$.each(data, function(idx, obj) {
						if(menu_id !=obj.menu_id ){
							$("#dd_parent_menu").append('<option value='+obj.menu_id+'>'+obj.menu_name+'</option>');
						}
				});
				if(menu_id !="-"){
					Get_Menu_Detail(menu_id);
				}
			}
	});
}
function Get_Menu_Detail(menu_id){
				$.ajax({
					url: backend_url+'Menu/Get_By_ID',
					data: {menu_id:menu_id},
					cache:false,
					type: "POST",
					dataType: "json",
					success: function (data)
						{
							$("#tb_menu_id").val(data.menu_id);
							$("#tb_menu_name").val(data.menu_name);
							$("#dd_parent_menu").val(data.parent_menu_id);
							$('#tb_link_url').val(data.link_url);
							$("#modal_menu").modal();
						}
				});
}

$('#tbody_menu').delegate('span.menu-edit', 'click', function() {
					Get_parent_Menu($.trim(event.target.id));
});

$('#modal_menu').delegate('span.menu-save', 'click', function() {
	$.ajax({
		url:  backend_url+'Menu/Edit',
		data: {menu_id:$("#tb_menu_id").val(),menu_name:$('#tb_menu_name').val(),link_url:$('#tb_link_url').val(),parent_menu_id:$('#dd_parent_menu :selected').val()},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data = "true"){
				alert("บันทึ่กขึ้อมูลเรียบร้อย");
				$('#tb_menu_name').val("");
				$('#tb_link_url').val("");
				$('#modal_menu').modal('toggle');
					Get_All_menu();
				}
			}
	});
});



$('#tbody_menu').delegate('span.menu-remove', 'click', function() {
	var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
	if (r == true) {
		$.ajax({
			  url:  backend_url+'Menu/Delete',
			  data: {menu_id:$.trim(event.target.id)},
			   type: "post",
			  cache:false,
			  success: function (data)
			  {
				 if(data = "true")   Get_All_menu();
			  }
		});
	}
});
