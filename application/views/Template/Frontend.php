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

			<!-- Mobile Internet Explorer ClearType Technology -->
			<!--[if IEMobile]>  <meta http-equiv="cleartype" content="on">  <![endif]-->


			 <!-- Mobile Specifics -->
	 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 		<meta name="HandheldFriendly" content="true"/>
	 		<meta name="MobileOptimized" content="320"/> 
		
			<?php
				if(!empty($meta))
						foreach($meta as $name=>$content){
								echo "\n\t\t";
								?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
				 }
		   ?>
<meta name="author" content="www.VTCarService.net">
			<!-- Bootstrap -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/bootstrap.min.css" rel="stylesheet">

			<!-- Main Style -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/main.css" rel="stylesheet">

			<!-- Supersized -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/supersized.css" rel="stylesheet">
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/supersized.shutter.css" rel="stylesheet">

			<!-- FancyBox -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/fancybox/jquery.fancybox.css" rel="stylesheet">

			<!-- Font Icons -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/fonts.css" rel="stylesheet">

			<!-- Shortcodes -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/shortcodes.css" rel="stylesheet">

			<!-- Responsive -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/bootstrap-responsive.min.css" rel="stylesheet">
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/responsive.css" rel="stylesheet">

			<!-- Supersized -->
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/supersized.css" rel="stylesheet">
			<link href="<?php echo base_url(); ?>Assets/Frontend/css/supersized.shutter.css" rel="stylesheet">

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
       <!-- content -->
        <?php echo $output;?>
        <!--/.content-->
      

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/ie10-viewport-bug-workaround.js"></script>


<!-- Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'Insert Your Code']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- End Analytics -->

<!-- Js  -->
<script src="<?php echo base_url(); ?>Assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/holder.min.js"></script>
<!-- End Js Frontend-->

<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";  
</script>

<!-- Js Frontend -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/supersized.3.2.7.min.js"></script> <!-- Slider -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/waypoints.js"></script> <!-- WayPoints -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/waypoints-sticky.js"></script> <!-- Waypoints for Header -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/jquery.isotope.js"></script> <!-- Isotope Filter -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/jquery.fancybox.pack.js"></script> <!-- Fancybox -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/jquery.fancybox-media.js"></script> <!-- Fancybox for Media -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/jquery.tweet.js"></script> <!-- Tweet -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/plugins.js"></script> <!-- Contains: jPreloader, jQuery Easing, jQuery ScrollTo, jQuery One Page Navi -->
<script src="<?php echo base_url(); ?>Assets/Frontend/js/main.js"></script> <!-- Default JS -->
<!-- End Js Frontend-->

<script type="text/javascript"> 

$(document).ready(function(){



});

</script>
<?php
	 foreach($js as $file){
			echo "\n\t\t";
			?><script src="<?php echo $file; ?>"></script><?php
		 } echo "\n\t";
 ?>
</body>
</html>
