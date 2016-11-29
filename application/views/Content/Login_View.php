  <div class="container" ng-app="App" >
           <div   align='center' >
              <img src="<?php echo base_url(); ?>Assets/Images/logo&sloganNobg.png" />
            </div>
    <div class="form-signin text-center" ng-controller="loginController" >
  		<form id="login-form" action="#">

  			<label for="inputEmail" class="sr-only">ชื่อผู้ใช้</label>
  			<input type="text" id="inputUsername" class="form-control" placeholder="Username" ng-model="username"  autofocus>
  			<label for="inputPassword" class="sr-only">รหัสผ่าน</label>
  			<input type="password" id="inputPassword"  ng-keypress="checkIfEnterKey($event)" ng-model="password"  class="form-control" placeholder="Password" >

  			<button class="btn btn-primary btn-lg btn-block" ng-click="check_auth()" type="Submit">Login</button>

  		</form>
         <div class="row">&nbsp;</div>
        <div   class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
    </div>

    </div> <!-- /container -->
