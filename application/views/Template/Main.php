<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>
		<title><?php echo $title; ?></title>
		<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="ศูนย์เคลือบสี เคลือบแก้ว เชียงใหม่ ด้วยสุดยอดนวัตกรรมหนึ่งเดียวเพื่อการปกป้องสีรถอย่างสมบูรณ์แบบ">
		<meta name="keywords" content="เคลือบแก้ว เชียงใหม่, Glass Coating เชียงใหม่, เคลือบสีรถยนต์เชียงใหม่, ขัดลบรอยขนแมว, ล้าง-ฟื้นฟูรถทุกรูปแบบในเชียงใหม่, ศูนย์ประดับยนต์ครบวงจร เชียงใหม่">
		<meta name="author" content="www.VTCarService.net">
			<?php
				if(!empty($meta))
						foreach($meta as $name=>$content){
								echo "\n\t\t";
								?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
				 }
		   ?>
			 <!-- Mobile Specifics -->
	 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 		<meta name="HandheldFriendly" content="true"/>
	 		<meta name="MobileOptimized" content="320"/>
			<!-- Mobile Internet Explorer ClearType Technology -->
			<!--[if IEMobile]>  <meta http-equiv="cleartype" content="on">  <![endif]-->


			<!-- Bootstrap -->
			<link href="_include/css/bootstrap.min.css" rel="stylesheet">

			<!-- Main Style -->
			<link href="_include/css/main.css" rel="stylesheet">

			<!-- Supersized -->
			<link href="_include/css/supersized.css" rel="stylesheet">
			<link href="_include/css/supersized.shutter.css" rel="stylesheet">

			<!-- FancyBox -->
			<link href="_include/css/fancybox/jquery.fancybox.css" rel="stylesheet">

			<!-- Font Icons -->
			<link href="_include/css/fonts.css" rel="stylesheet">

			<!-- Shortcodes -->
			<link href="_include/css/shortcodes.css" rel="stylesheet">

			<!-- Responsive -->
			<link href="_include/css/bootstrap-responsive.min.css" rel="stylesheet">
			<link href="_include/css/responsive.css" rel="stylesheet">

			<!-- Supersized -->
			<link href="_include/css/supersized.css" rel="stylesheet">
			<link href="_include/css/supersized.shutter.css" rel="stylesheet">

			<!-- Google Font -->
			<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>

			<!-- Fav Icon -->
			<link rel="shortcut icon" href="<?php echo base_url();?>Assets/Images/fav-icon-vtcar.png">
			<link rel="apple-touch-icon" href="#">
			<link rel="apple-touch-icon" sizes="114x114" href="#">
			<link rel="apple-touch-icon" sizes="72x72" href="#">
			<link rel="apple-touch-icon" sizes="144x144" href="#">


			<?php
					 foreach($css as $file){
							echo "\n\t\t";
							?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
					 } echo "\n\t";
			?>
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
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/Common.js"></script>
<!-- Modernizr -->
<script src="_include/js/modernizr.js"></script>

<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";


$(document).ready(function(){



});

</script>
<?php  foreach($js as $file){ ?><script src="<?php echo $file; ?>"></script><?php } ?>
</body>
</html>
