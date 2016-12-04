app.controller('slipController', function($scope, $http) {

    $scope.order_id = ""; //declare   empty
    $scope.emp_name =  "";
    $scope.tel = "";
    $scope.salary =  "";
    $scope.l_name =  "";
    $scope.date = new Date();

    $scope.services = []; //declare an empty array

    if (document.URL.indexOf("=")> 0 ){
        var idarr = document.URL.split("=");
        $scope.slip_id = idarr[1];
        $http.post(backend_url + 'Employee/Get_Salary_Byid', { 'id': $scope.slip_id })
        .success(function(data) {
          console.log(data);
          $scope.emp_name =  data.emp_name;
          $scope.tel = data.tel;
          $scope.salary =  data.salary;
          $scope.l_name =  data.l_name;
          $scope.date = new Date();
        }).error(function(err) {
            console.log(err);
        });
      }
});
