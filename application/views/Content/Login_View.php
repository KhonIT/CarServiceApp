<div class="container " ng-app="AppAngular" >
          <div class=" text-center banner"  >
            <img src="<?php echo base_url(); ?>Assets/Images/logo&sloganNobg.png" />
          </div>
  <div ng-controller="loginController" >
    <form class='form-signin' id="login-form" action="#"> 
      <label for="inputUsername" class="sr-only">ชื่อผู้ใช้</label>
      <input type="text" id="inputUsername"   placeholder="Username" ng-model="username"  autofocus>
      <label for="inputPassword" class="sr-only">รหัสผ่าน</label>
      <input type="password" id="inputPassword"  ng-keypress="checkIfEnterKey($event)" ng-model="password"   placeholder="Password" > 
      <input class="sign-in" ng-click="check_auth()" type="Submit" value="Submit"/> 
      <div   class="alert  hidden text-center"  id="msgbox" > {{msg}}  </div>
  </div>
    </form> 
  </div>
