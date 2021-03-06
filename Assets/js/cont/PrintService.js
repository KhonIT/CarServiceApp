app.controller('printController', function($scope, $http) {

    $scope.id = ""; //declare   empty
    $scope.book_no =  "";
    $scope.number =  "";
    $scope.cus_tel = "";
    $scope.cus_name =  "";
    $scope.cus_tel = "";
    $scope.cus_car_regis_number =  "";
    $scope.cus_car_brand =  "";
    $scope.cus_car_model =  "";
    $scope.cus_car_color = "";
    $scope.total_price = "";
    $scope.date = new Date();

    $scope.services = []; //declare an empty array

    if (document.URL.indexOf("=")> 0 ){
        var idarr = document.URL.split("=");
        $scope.id = idarr[1];
        $http.post(backend_url + 'Print_Service/Get_OrdersDetails_Print', { 'id': $scope.id })
        .success(function(response) {
            $scope.services = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
      }); 
        $http.post(backend_url + 'Print_Service/Get_By_ID', { 'id': $scope.id })
        .success(function(data) {
            $scope.book_no = data.book_no; 
            $scope.cus_name = data.cus_name;
            $scope.cus_tel = data.cus_tel ;
            $scope.cus_car_regis_number = data.cus_car_regis_number; 
            $scope.cus_car_brand = data.cus_car_brand;
            $scope.cus_car_model = data.cus_car_model;
            $scope.cus_car_color = data.cus_car_color;
            $scope.total_price =  data.total_price; 
            $scope.date = new Date();
        }).error(function(err) {
          console.log("Error:"+err);
        });

    }
});
