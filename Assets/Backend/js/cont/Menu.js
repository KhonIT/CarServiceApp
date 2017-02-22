app.controller('serviceController', function($scope, $http, $timeout,$location,$anchorScroll) {

    $scope.menu = []; //declare an empty array
    $scope.menu_id = "";
    $scope.menuname =  "";
    $scope.price =  "";
    $scope.msg="";

    $http.get(backend_url + 'Services/Get_All').success(function(response) {
      $scope.services = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
      console.log(err);
    });

    $scope.getData = function() {
        $http.get(backend_url + 'Services/Get_All').success(function(response) {
            $scope.services = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
        })
    }

    $scope.ins = function() {
      $scope.service_id = "0";
      $scope.service_name =  "";
      $scope.price =  "";
      $("#modal_data").modal();
    }

    $scope.edit = function(id) {
        $http.post(backend_url + 'Services/Get_By_ID', { 'id': id })
            .success(function(data) {
                $scope.service_id = data.service_id;
                $scope.service_name =  data.service_name;
                $scope.price =  data.price;
                $("#modal_data").modal();
            }).error(function(err) {
                console.log(err);
            })
    }

    $scope.save = function(id) {
       //for-debug
       //console.log($scope.emp_id+':'+$scope.emp_name);
    var param  ={};
    if (id == "0"){param = {id: id,service_name: $scope.service_name, price: $scope.price};}else{param = {id: id,service_name: 	$("#tb_name_"+id).val(), price: 	$("#tb_price_"+id).val()};} 
        $http.post(backend_url + 'Services/Edit',param).success(function(data) {
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


        $scope.del = function(id) {
            var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
            if (r == true) {
                $http.post(backend_url + 'Services/Delete', { 'id': id })
                    .success(function(data) {
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
        }


    $scope.displaymsgsuccess = function(){
      $location.hash('top-panel');
       $anchorScroll();
      $('#msgbox').addClass( "alert-success" ).removeClass( "alert-warning hidden");
      $timeout(function() {
           $('#msgbox').addClass( "hidden" )
        }, 1500); // delay 1500 ms
    }
    $scope.displaymsgwarning = function(){
      $location.hash('top-panel');
       $anchorScroll();
      $('#msgbox').addClass( "alert-warning" ).removeClass( "alert-success hidden" );
      $timeout(function() {
           $('#msgbox').addClass( "hidden" )
        }, 1500); // delay 1500 ms
    }

});
