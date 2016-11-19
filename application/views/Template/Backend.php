<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="www.VTCarService.net">
			<?php
				if(!empty($meta))
						foreach($meta as $name=>$content){
								echo "\n\t\t";
								?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
				 }
		   ?>

<link rel="shortcut icon" href="<?php echo base_url(); ?>Assets/Images/fav-icon-vtcar.png">
<link href="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>Assets/Backend/css/Admin.css" rel="stylesheet">
<?php  foreach($css as $file){  ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php	 }  ?>
			<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
		</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">VTCar Service</a>
          </div>
          <div class="navbar-collapse collapse">
           <ul class="nav navbar-nav " id="menu_nav">
			 <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  ลูกค้า<span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li role="separator" class="divider"></li>
				<li><a href="<?php echo base_url(); ?>customer_service">ประวัติการใช้บริการ</a></li>
				<li><a href="<?php echo base_url(); ?>service">รับรถ</a></li>
				<li role="separator" class="divider"></li>
			  </ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  พนักงาน<span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li role="separator" class="divider"></li>
				<li><a href="<?php echo base_url(); ?>#">ลงเวลางาน</a></li>
				<li role="separator" class="divider"></li>
			  </ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  รายงาน<span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li role="separator" class="divider"></li>
				<li><a href="<?php echo base_url(); ?>#">การบริการ</a></li>
				<li><a href="<?php echo base_url(); ?>#">การลงเวลาพนักงาน</a></li>
				<li role="separator" class="divider"></li>
			  </ul>
			</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ตั้งค่า <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url(); ?>Employee">จัดการข้อมูลพนักงาน</a></li>
							<li><a href="<?php echo base_url(); ?>Level">จัดการสิทธิ์การใช้งาน</a></li>
							<li><a href="<?php echo base_url(); ?>Menu">จัดการเมนู</a></li>
							<li><a href="<?php echo base_url(); ?>Service/Setup">การบริการ</a></li>
							<li role="separator" class="divider"></li>
						</ul>
				</li>
          </ul>

			<div class="navbar-form navbar-right">
				<ul class="nav navbar-nav  ">
					<li class=" dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="User_Profile">  </a>
						<ul class=" dropdown-menu">
							<li role="separator" class="divider"></li>
							<li  class="logoutform"> <a href="#"  class=" btnlogout ">ออกจากระบบ</a></li>
							<li role="separator" class="divider"></li>
						</ul>
					</li>
				</ul>
			</div>
        </div>
	</nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12  main">
	<div   align='center' > <span id="result_content" ></span></div>
       <!-- content -->
        <?php echo $output;?>
        <!--/.content-->
        </div>
      </div>
    </div>
<script src="<?php echo base_url(); ?>Assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/angular.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/ie10-viewport-bug-workaround.js"></script> 
<script type="text/javascript">

var base_url = "<?php echo base_url();?>";
var backend_url = "<?php echo base_url();?>Backend/";
</script>
<script src="<?php echo base_url(); ?>Assets/Backend/js/Common.js"></script>
<script type="text/javascript"> 
$('.logoutform').delegate('a.btnlogout', 'click', function() {
	$.ajax({
		url:  backend_url+'Employee/logout',
		data: {},
		type: "POST",
		cache:false,
		success: function (data) {
			if(data = "true"){
				$('#result_content').text(" ออกจากระบบเรียบร้อยแล้ว ");
				window.setTimeout('location.reload()', 1000);
			}
		}
	});
});

$(document).ready(function(){

	$.ajax({
		url:  backend_url+'Employee/Get_Profile',
		data: {},
		type: "POST",
		dataType: "json",
		cache:false,
		success: function (data) {

			$("#User_Profile").text("");
			$("#User_Profile").append(data.name+':'+data.l_name+'<span class="caret"></span>');

		}
	});

	$.ajax({
		url:  backend_url+'Permission/Get_Menu',
		data: {},
		type: "POST",
		dataType: "json",
		cache:false,
		success: function (data) {

			$("#menu_nav").text("");
			$.each(data, function(idx, obj) {
					if (obj.parent_menu=="0")
					{
						$("#menu_nav").append('<li class="dropdown" ><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'+obj.menu_name+'<span class="caret"></span></a><ul class="dropdown-menu" id="menu'+obj.menu_id+'"></ul></li>');
					}else{
						$("#menu"+obj.parent_menu_id).append('	<li><a href="'+backend_url+''+obj.link_url+'">'+obj.menu_name+'</a></li> ');

					}
			});
		}
	});


});

</script>
  <?php  foreach($js as $file){ ?><script src="<?php echo $file; ?>"></script><?php } ?>
</body>
</html>
