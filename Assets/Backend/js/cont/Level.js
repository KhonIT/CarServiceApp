app.controller('customerController', function($scope, $http, $timeout) {

    $scope.level = []; //declare an empty array
    //declare empty
    $scope.l_id = "";
    $scope.l_name =  "";
    $scope.pa = "";
    $scope.cus_car_regis_number =  "";
    $scope.cus_car_brand =  "";
    $scope.cus_car_model =  "";
    $scope.cus_car_color = "";
    $scope.msg="";
    $http.get(backend_url + 'Customer/Get_All').success(function(response) {
        $scope.customers = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $scope.getData = function() {
        $http.get(backend_url + 'Customer/Get_All').success(function(response) {
            $scope.customers = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
        })
    }
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.dellevel = function(cusid) {
        var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
        if (r == true) {
            $http.post(backend_url + 'Customer/Delete', { 'id': cusid })
                .success(function(data) {
                    if (angular.equals(data, "true")  ){
                        $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";
                        $scope.displaymsginfo();
                        $scope.getData();
                    }else{
                      $scope.msg ="บันทึ่กขึ้อมูลไม่สำเร็จ";
                      $scope.displaymsgwarning();
                    }

                }).error(function(err) {
                    console.log(err);
                })
        }
    }

    $scope.inslevel = function() {
      $scope.cus_id = "0";
      $scope.cus_name =  "";
      $scope.cus_tel = "";
      $scope.cus_car_regis_number =  "";
      $scope.cus_car_brand =  "";
      $scope.cus_car_model =  "";
      $scope.cus_car_color = "";
      $("#modal_data").modal();
    }

    $scope.editlevel = function(cusid) {
        $http.post(backend_url + 'Customer/Get_By_ID', { 'id': cusid })
            .success(function(data) {
                $scope.cus_id = data.id;
                $scope.cus_name =  data.cus_name;
                $scope.cus_tel =  data.cus_tel;
                $scope.cus_car_regis_number =  data.cus_car_regis_number;
                $scope.cus_car_brand =  data.cus_car_brand;
                $scope.cus_car_model =  data.cus_car_model;
                $scope.cus_car_color =  data.cus_car_color;
                $("#modal_data").modal();
            }).error(function(err) {
                console.log(err);
            })
    }

    $scope.savecus = function() {
       //for-debug
       //console.log($scope.cus_id+':'+$scope.cus_name);
        $http.post(backend_url + 'Customer/Edit', { id: $scope.cus_id, cus_name: $scope.cus_name, cus_tel: $scope.cus_tel, cus_car_regis_number: $scope.cus_car_regis_number, cus_car_brand: $scope.cus_car_brand, cus_car_model: $scope.cus_car_model, cus_car_color:$scope.cus_car_color })
            .success(function(data) {

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
    $http.get(backend_url + 'Customer/Get_Logo').success(function(response) {
        $scope.logos = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $scope.iconlogo_click = function(iconname) {
                $scope.cus_car_brand =  iconname;
    }
});
