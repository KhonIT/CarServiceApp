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
<?php  foreach($css as $file){  ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php	 }  ?>
			<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
		</head>
<body>


       <!-- content -->
        <?php echo $output;?>
        <!--/.content-->

<script src="<?php echo base_url(); ?>Assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/js/angular.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url(); ?>Assets/bootstrap-3.3.5/js/ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";
	var backend_url = "<?php echo base_url();?>Backend/";
	var app = angular.module('AppAngular', []);
</script>
<script src="<?php echo base_url(); ?>Assets/Backend/js/Common.js"></script>
  <?php  foreach($js as $file){ ?><script src="<?php echo $file; ?>"></script><?php } ?>
</body>
</html>
