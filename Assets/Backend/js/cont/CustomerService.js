app.controller('cusServiceController', function($scope, $http, $timeout) {
    $scope.logos = []; //declare an empty array
    $scope.services = []; //declare an empty array
    $scope.service_all = []; //declare an empty array
  //declare empty
    $scope.cus_id = "";
    $scope.cus_name =  "";
    $scope.cus_tel = "";
    $scope.car_id = "";
    $scope.car_regis_number =  "";
    $scope.car_brand =  "";
    $scope.car_model =  "";
    $scope.car_color = "";
    $scope.total_price = ""; 

    $scope.comment  = ""; 
    $scope.msg = ""; 
    
    $http.get(backend_url + 'Customer/Get_Logo').success(function(response) {
        $scope.logos = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $http.get(backend_url + 'Services/Get_All').success(function(response) {
        $scope.service_all = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });
    $scope.servicelist = function() {
      $('#modal_data_service_detail').modal();
    } 

    $scope.iconlogo_click = function(iconname) {
      $scope.cuscar_brand =  iconname;
    }  

    $scope.addcar = function() {
    $scope.cus_id = "0";
    $scope.cus_id = "";
    $scope.cus_name =  "";
    $scope.cus_tel = "";
    $scope.car_id = "0";
    $scope.car_regis_number =  "";
    $scope.car_brand =  "";
    $scope.car_model =  "";
    $scope.car_color = "";
    $scope.total_price = ""; 
      $('#modal_data_car').modal();
    }


    $scope.savecar = function() {
       //for-debug
       //console.log($scope.cus_id+':'+$scope.cus_name);
        $('#modal_data_car').modal('hide');   
        $http.post(backend_url + 'Customer/Edit', { id: $scope.cus_id, cus_name: $scope.cus_name, cus_tel: $scope.cus_tel, car_regis_number: $scope.car_regis_number, car_brand: $scope.car_brand, car_model: $scope.car_model, car_color:$scope.car_color })
            .success(function(data) { 
              if (angular.equals(data, "true")  ){ 
                  $scope.displaymsgsuccess();
                  $scope.getData(); 
              }else{
                $scope.msgcus ="บันทึ่กขึ้อมูลไม่สำเร็จ";
                $scope.displaymsgwarning();
              }

            }).error(function(err) {
                console.log(err);
            })
    }

    $scope.saveservice = function() {
      $scope.services = [];
      var sum =parseFloat(0.00);
      $('input:checkbox[id^="service_detail"]').each(function(){
                if($(this).prop("checked")){
                sum+= parseFloat($("#price-"+$(this).val()).val());
                    var obj = { service_id: $(this).val() ,name:  $("#name-"+$(this).val()).val(),price: $("#price-"+$(this).val()).val(),is_show : '1'};
                    $scope.services.push(obj);
                }
      });
         $scope.total_price = parseFloat(sum) ;
          //console.log($scope.services);
          $('#modal_data_service_detail').modal('hide');
    }

 

    $scope.savecusservice = function() {
       //for-debug
        //console.log($scope.cus_id+':'+$scope.total_price);
  if (angular.equals($scope.cus_id , "")  ){
    $scope.msg ="กรุณากรอกข้อมูล";
    $scope.displaymsgwarning();
  }else{
        $http.post(backend_url + 'Customer_Service/AddService', {
            cus_id: $scope.cus_id,
            total_price: $scope.total_price,
            comment: $scope.comment,
            services: JSON.stringify($scope.services),
          }).success(function(data) {
              $('#modal_data').modal('hide');
              if (angular.equals(data, "true")  ){
                  $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";

                  $scope.displaymsgsuccess();
                   //clear 
                  $scope.services = [];
                  $scope.service_all = [];

                  $scope.cus_id = "";
                  $scope.cus_name =  "";
                  $scope.cus_tel = "";
                  $scope.car_regis_number =  "";
                  $scope.car_brand =  "";
                  $scope.car_model =  "";
                  $scope.car_color = "";
                  $scope.total_price = "";

                  $scope.total_price  = "";
                  $scope.comment  = "";

              }else{
                $scope.msg ="บันทึ่กขึ้อมูลไม่สำเร็จ";
                $scope.displaymsgwarning();
              }
            }).error(function(err) {
                console.log(err);
            })
              }
    }

    $scope.car_search = function () {
      $http.post(backend_url + 'Customer/Get_By_CarRegisNumber', { 'car_regis_number': $scope.car_regis_number })
          .success(function (data) {  
              $scope.cus_id = data.cus_id;
              $scope.cus_name =  data.cus_name;
              $scope.cus_tel = data.cus_tel;
              $scope.cus_id = data.car_id;
              $scope.car_regis_number = data.car_regis_number;
              $scope.car_regis_province =  data.car_regis_province;
              $scope.car_brand =  data.car_brand;
              $scope.car_model =  data.car_model;
              $scope.car_color =  data.car_color; 
          }).error(function(err) {
              console.log(err);
          })
    }

    $scope.displaymsgsuccess = function(){
      $('#msgbox').addClass( "alert-success" ).removeClass( "alert-warning hidden");
      $timeout(function() {
           $('#msgbox').addClass( "hidden" )
        }, 1500); // delay 1500 ms
    }
    $scope.displaymsgwarning = function(){
      $('#msgbox').addClass( "alert-warning" ).removeClass( "alert-success hidden" );
      $timeout(function() {
           $('#msgbox').addClass( "hidden" )
        }, 1500); // delay 1500 ms
    } 
});
