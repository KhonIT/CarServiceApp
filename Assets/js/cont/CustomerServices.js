app.controller('cusServicesController', function($scope, $http, $timeout) {
  
    $scope.customer_service = []; //declare an empty array 
    $scope.msg = "";  
    $scope.id = "";   
    $scope.payment_status = ""; 

    $http.get(backend_url + 'Customer_Service/Get_All_UnPay').success(function(response) { 
        $scope.customer_service = response; //ajax request to fetch data into $scope.data 
    }).error(function(err) {
        console.log(err);
    });
 
    $scope.EditCusService= function(id){
        //คงค้างแก้ไข
        console.log(id);
    }
    $scope.payment= function(id){ 
        $('#modal_data_payment').modal();
        $scope.payment_status = "cash"; 
        $scope.id = id;   
    } 

    $scope.confirm_print= function(){ 
            window.open(backend_url+'Customer_Service/PrintReceived?order_id='+$scope.id,'_blank');
            $timeout(function() { $scope.Get_All_service(); }, 2000);  
    } 

     $scope.removeCusService= function(id){
        var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
        if (r === true) {
           
            $http.post(backend_url + 'Customer_Service/Delete', { 'id': id })
            .success(function (data) { 
                if (data== "true")  {
                    $scope.Get_All_service();
                }   
            }).error(function(err) {
                console.log(err);
            })
            
        }
      
    } 
    $scope.Get_All_service= function(id){
        $http.get(backend_url + 'Customer_Service/Get_All_UnPay').success(function(response) { 
            $scope.customer_service = response; //ajax request to fetch data into $scope.data  
        }).error(function(err) {
            console.log(err);
        });  
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
