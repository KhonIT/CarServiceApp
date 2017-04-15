app.controller('salaryController', function($scope, $http, $timeout) {

    $scope.employees = []; //declare an empty array

    $scope.msg="";

    $http.get(backend_url + 'Employee/Get_Salary').success(function(response) {
                  $scope.employees = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $scope.getData = function() {
        $http.get(backend_url + 'Employee/Get_Salary').success(function(response) {
            $scope.employees = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
        })
    }


    $scope.calsalary = function() {
      $http.get(backend_url + 'Employee/Cal_Salary').success(function(data) {
        $scope.msg ="คำณวนข้อมูลเงินเดือนเรียบร้อย";
        $scope.displaymsgsuccess();
        $scope.getData();
      }).error(function(err) {
          console.log(err);
      })
    }

    $scope.delsalary = function(id) {
        var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
        if (r == true) {
            $http.post(backend_url + 'Employee/Del_Salary', { 'id': id })
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
