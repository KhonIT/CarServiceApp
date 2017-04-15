

app.controller('homeController', function($scope, $http, $timeout) {

    $scope.menus = []; //declare an empty array
    //declare empty  
	
    $http.get(backend_url + 'Permission/Get_Menu_Home').success(function(response) {
        $scope.menus = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    }); 

});
