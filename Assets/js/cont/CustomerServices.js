app.controller('cusServicesController', function($scope, $http, $timeout) {
  
    $scope.customer_service = []; //declare an empty array 
    $scope.msg = "";  
    $scope.id = "";   
    $scope.book_no = "";   
    $scope.number = ""; 
    $scope.payment_status = "";  
    $scope.total_price = "";
    $scope.comment  = "";

    $http.get(backend_url + 'Customer_Service/Get_All_UnPay').success(function(response) { 
        $scope.customer_service = response; //ajax request to fetch data into $scope.data 
    }).error(function(err) {
        console.log(err);
    }); 
    $scope.payment= function(id){ 
        $('#modal_data_payment').modal(); 
        $http.post(backend_url + 'Customer_Service/Get_By_ID', { 'id': id })
        .success(function (data) {   
            $scope.id   = data.id; 
            $scope.book_no =data.book_no; 
            $scope.payment_status = data.payment_status;
            $scope.total_price =  data.total_price;
            $scope.comment =  data.comment
            console.log(    $scope.id);
        }).error(function(err) {
            console.log(err);
        });  
    } 

    $scope.confirm_print= function(){  
        console.log($scope.id);
        $http.post(backend_url + 'Customer_Service/Payment', { id: $scope.id,book_no: $scope.book_no,payment_status: $scope.payment_status,total_price: $scope.total_price,comment: $scope.comment })
        .success(function (data) { 
            if (data== "true")  {
                $scope.Get_All_service(); 
                window.open(backend_url+'Customer_Service/PrintReceived?order_id='+$scope.id,'_blank'); 
                $('#modal_data_payment').modal('hide');
                $scope.id = "";   
                $scope.book_no = "";   
                $scope.number = ""; 
                $scope.payment_status = "";  
                $scope.total_price = "";
                $scope.comment  = "";
         
            }   
        }).error(function(err) {
            console.log(err);
        })


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
         
});
