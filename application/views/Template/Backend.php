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
<body ng-app="AppAngular">
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
			         <!-- menu_nav -->

          </ul>

			<div class="navbar-form navbar-right">
				<ul class="nav navbar-nav  ">
					<li class=" dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="User_Profile">  </a>
						<ul class=" dropdown-menu">
							<li role="separator" class="divider"></li>
							<li  class="editempform"> <a href="#"  class="editemp">แก้ไขข้อมูลรหัสผ่าน</a></li>
							<li  class="logoutform"> <a href="#"  class="btnlogout ">ออกจากระบบ</a></li>
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
		<div class='modal fade' id='modal_data_editemp' role='dialog'    >
			<div class='modal-dialog' >
			<div  class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal'>&times;</button>
					<h4><span class='glyphicon '></span>ข้อมูลผู้ใช้</h4>
				</div>
				<div class='modal-body' align='center'    >
					<table class="table-modal"   ng-controller="empController">
						<tr>
							<td colspan="2">ชื่อ :{{empname}}</td>
						</tr>
						<tr>
							<td colspan="2"> ชื่อเล่น: {{empnickname}}</td>
						<tr>
							<td colspan="2"> ชื่อผู้ใช้:{{empusername}}</td>
						</tr>
						<tr>
							<td> แก้ไขรหัสผ่าน</td>
							<td>
								<input type="text" name="tb_e_password" id="tb_e_password"   ng-model="emppassword"/>
							</td>
						</tr>

						<tr>
							<td>บันทึก:</td>
							 <td><span  class="glyphicon glyphicon-floppy-save data-save icon" ng-click="saveemp()"></span></td>
						</tr>
					</table>
				</div>
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
var app = angular.module('AppAngular', []);

</script>
<script src="<?php echo base_url(); ?>Assets/Backend/js/Common.js"></script>
<script type="text/javascript">

app.controller('empController', function($scope, $http, $timeout) {
		//declare empty
		$scope.empname =  "";
		$scope.empnickname = "";
		$scope.empusername =  "";
		$scope.emppassword =  "";

		$http.get(backend_url + 'Employee/Get_Emp').success(function(data) {
			$scope.empname =  data.emp_name;
			$scope.empnickname = data.emp_nickname;
			$scope.empusername =  data.emp_username;
			$scope.emppassword =  data.emp_password;
		}).error(function(err) {
				console.log(err);
		});

		    $scope.getDataEmp = function() {
		        $http.get(backend_url + 'Employee/Get_Emp').success(function(data) {
							$scope.empname =  data.emp_name;
							$scope.empnickname = data.emp_nickname;
							$scope.empusername =  data.emp_username;
							$scope.emppassword =  data.emp_password;
		        }).error(function(err) {
		            console.log(err);
		        })
		    }
		$scope.saveemp = function() {
       //for-debug
       //console.log($scope.emp_id+':'+$scope.emp_name);
        $http.post(backend_url + 'Employee/Edit_Emp', {
            emp_password: $scope.emppassword
          }).success(function(data) {

              $('#modal_data_editemp').modal('toggle');
              if (angular.equals(data, "true")  ){
                alert("บันทึ่กขึ้อมูลเรียบร้อย");
                 $scope.getDataEmp();
              }else{
								alert("บันทึ่กขึ้อมูลไม่สำเร็จ");
              }

            }).error(function(err) {
                console.log(err);
            })
    }

});

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

$('.editempform').delegate('a.editemp', 'click', function() {
    $("#modal_data_editemp").modal();
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
			$("#User_Profile").append(data.emp_name+':'+data.l_name+'<span class="caret"></span>');

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
			var count = 1;
			$.each(data, function(idx, obj) {

					if (obj.parent_menu=="0")
					{
						$("#menu_nav").append('<li class="dropdown" ><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'+obj.menu_name+'<span class="caret"></span></a><ul class="dropdown-menu" id="menu'+obj.menu_id+'"></ul></li>');
						count ++;
					}else{
						if (obj.is_edit=="1"){
							$("#menu"+obj.parent_menu_id).append('	<li><a href="'+backend_url+''+obj.link_url+'">'+obj.menu_name+'</a></li> ');
						}
					}
			});
			$.each(data, function(idx, obj) {
				if (obj.parent_menu=="0")
				{
					//degug console.log(obj.menu_id+':#menu'+obj.menu_id+' li');
					//degug console.log($("#menu"+obj.menu_id+" li").children().length==0);
						 if($("#menu"+obj.menu_id+" li").children().length==0){
							 $("#menu"+obj.menu_id).parent('li').addClass("hidden");
						 }
				}
			});
		}
	});


});

</script>
  <?php  foreach($js as $file){ ?><script src="<?php echo $file; ?>"></script><?php } ?>
</body>
</html>
