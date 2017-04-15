app.controller('loginController', function($scope, $http, $timeout) { 
    //declare empty
    $scope.username = "";
    $scope.password =  "";
    $scope.msg="";


    $scope.check_auth = function() {
        	if(( $scope.username.length> 0)&& ($scope.password.length > 0) ) {
            $http.post(backend_url + 'Login/check_auth', { username: $scope.username, password: $scope.password})
            .success(function(response) {

              if (angular.equals(response, "true")  ){
                  $scope.msg ="ยินดีต้อนรับเข้าสู่ระบบ";
                  $scope.displaymsgsuccess();
                  $timeout(function() {
                   location.reload();
                    }, 1500); // delay 1500 ms
              }else{
                $scope.msg ="ผิดพลาด กรุณาตรวจสอบการเข้าสู่ระบบอีกครั้ง";
                $scope.displaymsgwarning();
              }
            }).error(function(err) {
                console.log(err);
            })
          }else{
            if(angular.equals($scope.username.length, 0)  ){
              $scope.msg =" กรุณากรอก Username";
              $scope.displaymsgwarning();
            }else if(angular.equals($scope.password.length, 0) ){
              $scope.msg =" กรุณากรอก Password";
              $scope.displaymsgwarning();
            }else{
              $scope.msg ="ผิดพลาด กรุณาตรวจสอบการเช้าสู่ระบบอีกครั้ง";
              $scope.displaymsgwarning();

            }

          }
    }
    $scope.displaymsgsuccess = function(){
      $('#msgbox').addClass( "alert-success" ).removeClass( "alert-warning hidden");
    }
    $scope.displaymsgwarning = function(){
      $('#msgbox').addClass( "alert-warning" ).removeClass( "alert-success hidden" );
    }
    $scope.checkIfEnterKey = function($event){
      var keyCode = $event.which || $event.keyCode;
      //Debug console.log(keyCode);
        if (keyCode === 13) {

                    $scope.check_auth();

        }
    }

});
