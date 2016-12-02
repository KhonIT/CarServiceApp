app.controller('cusServiceController', function($scope, $http, $timeout) {

  $scope.customers = []; //declare an empty array
  $scope.logos = []; //declare an empty array
  //declare empty
  $scope.cus_id = "";
  $scope.cus_name =  "";
  $scope.cus_tel = "";
  $scope.cus_car_regis_number =  "";
  $scope.cus_car_brand =  "";
  $scope.cus_car_model =  "";
  $scope.cus_car_color = "";
  $scope.total_price = "";

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

    $scope.iconlogo_click = function(iconname) {
      $scope.cus_car_brand =  iconname;
    }
    $scope.cuslist = function() { 
      $('#modal_data_cus_search').modal();
    }

    $scope.savecusservice = function() {
       //for-debug
       //console.log($scope.emp_id+':'+$scope.emp_name);

        $http.post(backend_url + 'Customer_Service/AddService', {
            cus_id: $scope.cus_id,
            total_price: $scope.total_price,
            total_price: $scope.remark,
          }).success(function(data) {
              $('#modal_data').modal('toggle');
              if (angular.equals(data, "true")  ){
                  $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";
                  $scope.displaymsgsuccess();
                  $scope.getData();
              }else{
                $scope.msg ="บันทึ่กขึ้อมูลไม่สำเร็จ";
                $scope.displaymsgwarning();
              }
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
