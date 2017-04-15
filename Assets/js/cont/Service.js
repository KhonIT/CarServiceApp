app.controller('serviceController', function($scope, $http, $timeout,$location,$anchorScroll) {

    $scope.services = []; //declare an empty array
    $scope.service_name =  "";
    $scope.price =  "";
    $scope.car_size =  "";
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
      $scope.service_name =  "";
      $scope.price =  "";
      $scope.car_size =  "";
      $("#modal_data").modal();
    } 

    $scope.save = function(id) {
    $("#modal_data").modal('hide');
//for-debug
  // console.log($("#tb_name_"+id).val()+':'+$("#tb_name_"+id).val()+':'+$("#tb_car_size_"+id+" :selected").val());
    var param  ={};
    if (id == "0"){
        param = {id: id,service_name: $scope.service_name, price: $scope.price,car_size: $scope.car_size};
    }else{
        param = {id: id,service_name:$("#tb_name_"+id).val(), price:$("#tb_price_"+id).val(),car_size:$("#tb_car_size_"+id+" :selected").val()};
    } 
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
