app.controller('cusServicesController', function($scope, $http, $timeout) {
  
    $scope.customer_service = []; //declare an empty array
   
    $scope.msg = "";

 
 

    $http.get(backend_url + 'Customer_Service/Get_All_UnPay').success(function(response) { 
        $scope.customer_service = response; //ajax request to fetch data into $scope.data 
    }).error(function(err) {
        console.log(err);
    });
 
    $scope.EditCusService= function(id){

          console.log(id)
    }
    $scope.confirm_print= function(id){

          console.log(id)
    }

     $scope.removeCusService= function(id){

          console.log(id)
    }


    $scope.displaymsgsuccess = function(msg){
        if (msg.length == 0) {
            $scope.msg ="บันทึ่กข้อมูลสำเร็จ";
        }else{
            $scope.msg =msg;
        }
        $('.msgbox').addClass( "alert-success" ).removeClass( "alert-warning hidden"); 
        $timeout(function() { $('.msgbox').addClass( "hidden" ) }, 2000); // delay 1500 ms
    }
    $scope.displaymsgwarning = function(msg){
        if (msg.length == 0) {
            $scope.msg ="บันทึ่กข้อมูลไม่สำเร็จ";
        }else{
            $scope.msg =msg;
        }
            $('.msgbox').addClass( "alert-warning" ).removeClass( "alert-success hidden" );
            $timeout(function() { $('.msgbox').addClass( "hidden" ) }, 2000); // delay 1500 ms
        }
});
