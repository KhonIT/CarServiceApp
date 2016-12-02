app.controller('cusServiceController', function($scope, $http, $timeout) {

    $scope.customers = []; //declare an empty array
    $scope.logos = []; //declare an empty array
    $scope.services = []; //declare an empty array
    $scope.service_all = []; //declare an empty array
  //declare empty
    $scope.cus_id = "";
    $scope.cus_name =  "";
    $scope.cus_tel = "";
    $scope.cus_car_regis_number =  "";
    $scope.cus_car_brand =  "";
    $scope.cus_car_model =  "";
    $scope.cus_car_color = "";
    $scope.total_price = "";

    $scope.total_price  = "";
    $scope.comment  = "";
    $scope.msgcus="";
        $scope.msg="";
    $http.get(backend_url + 'Customer/Get_All').success(function(response) {
        $scope.customers = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });
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
      $scope.cus_car_brand =  iconname;
    }
    $scope.cuslist = function() {
      $('#modal_data_cus_search').modal();
    }


    $scope.addcus = function() {
      $scope.cus_id = "0";
      $scope.cus_name =  "";
      $scope.cus_tel = "";
      $scope.cus_car_regis_number =  "";
      $scope.cus_car_brand =  "";
      $scope.cus_car_model =  "";
      $scope.cus_car_color = "";
      $scope.total_price = "";
      $('#modal_data_cus_search').modal('toggle');
      $('#modal_data_add_cus').modal();
    }


    $scope.savecus = function() {
       //for-debug
       //console.log($scope.cus_id+':'+$scope.cus_name);
        $http.post(backend_url + 'Customer/Edit', { id: $scope.cus_id, cus_name: $scope.cus_name, cus_tel: $scope.cus_tel, cus_car_regis_number: $scope.cus_car_regis_number, cus_car_brand: $scope.cus_car_brand, cus_car_model: $scope.cus_car_model, cus_car_color:$scope.cus_car_color })
            .success(function(data) {

              if (angular.equals(data, "true")  ){
                  $scope.msgcus ="บันทึ่กขึ้อมูลเรียบร้อย";
                  $scope.displaymsgsuccess();
                  $scope.getData();
                  $('#modal_data_add_cus').modal('toggle');
                  $('#modal_data_cus_search').modal();

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
          $('#modal_data_service_detail').modal('toggle');
    }



    $scope.getData = function() {
        $http.get(backend_url + 'Customer/Get_All').success(function(response) {
            $scope.customers = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
        })
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
              $('#modal_data').modal('toggle');
              if (angular.equals(data, "true")  ){
                  $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";

                  $scope.displaymsgsuccess(); 
                   //clear
                  $scope.customers = [];
                  $scope.services = [];
                  $scope.service_all = [];

                  $scope.cus_id = "";
                  $scope.cus_name =  "";
                  $scope.cus_tel = "";
                  $scope.cus_car_regis_number =  "";
                  $scope.cus_car_brand =  "";
                  $scope.cus_car_model =  "";
                  $scope.cus_car_color = "";
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
    $scope.choosecus = function(cusid){
      $http.post(backend_url + 'Customer/Get_By_ID', { 'id': cusid })
          .success(function(data) {
              $scope.cus_id = data.id;
              $scope.cus_name =  data.cus_name;
              $scope.cus_tel =  data.cus_tel;
              $scope.cus_car_regis_number =  data.cus_car_regis_number;
              $scope.cus_car_brand =  data.cus_car_brand;
              $scope.cus_car_model =  data.cus_car_model;
              $scope.cus_car_color =  data.cus_car_color;
            $('#modal_data_cus_search').modal('toggle');
          }).error(function(err) {
              console.log(err);
          })
    }
});
