app.controller('menuController', function($scope, $http, $timeout,$location,$anchorScroll) {

    $scope.menus = []; //declare an empty array 
    $scope.menu_id =  "0";
    $scope.menu_name =  "";
    $scope.parent_menu_id =  "";
    $scope.menu_link_url =  "";
    $scope.msg="";

    $http.get(backend_url + 'Menu/Get_All').success(function(response) {
        $scope.menus = response;  //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

     $scope.getParentMenu = function(menu_id) {
        $("#dd_parent_menu").append('<option value="0">เมนูหลัก</option>');

        angular.forEach($scope.menus,  function(value, key) {
            if(menu_id !=value['menu_id']){
                $("#dd_parent_menu").append('<option value='+value['menu_id']+'>'+value['menu_name']+'</option>');
            }
        } );
     }
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }
    $scope.getData = function() {
        $http.get(backend_url + 'Menu/Get_All').success(function(response) {
            $scope.menus = response; //ajax request to fetch data into $scope.data      
        }).error(function(err) {
            console.log(err);
        })
    }

    $scope.ins = function() { 
        $scope.menu_id =  "0";
        $scope.menu_name =  "";
        $scope.parent_menu_id =  "";
        $scope.menu_link_url =  "";
        $scope.getParentMenu("-"); 
        $("#modal_data").modal();
    } 
    $scope.edit = function(id) { 
        $http.post(backend_url + 'Menu/Get_By_ID', { 'id': id })
            .success(function (data) {  
                $scope.menu_id = data.menu_id;
                $scope.menu_name =  data.menu_name;
                $scope.getParentMenu(data.menu_id); 
                $("#dd_parent_menu").val(data.parent_menu_id);
                $scope.menu_link_url =   data.menu_link_url; 
                $("#modal_data").modal();
            }).error(function(err) {
                console.log(err);
            })
    }
    $scope.save = function() {
       //for-debug
       //console.log($scope.emp_id+':'+$scope.emp_name);
      $("#modal_data").modal('hide');
        var param  ={menu_id: $scope.menu_id,menu_name: $scope.menu_name, parent_menu_id:$('#dd_parent_menu :selected').val() ,menu_link_url:$scope.menu_link_url}
        $http.post(backend_url + 'Menu/Edit',param).success(function(data) {
              if (angular.equals(data, "true")  ){
                  $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";
                  $scope.getData();
                  $scope.displaymsgsuccess();
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
                $http.post(backend_url + 'Menu/Delete', { 'id': id })
                    .success(function(data) {
                      if (angular.equals(data, "true")  ){
                          $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";
                            $scope.getData();
                          $scope.displaymsgsuccess();
                
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
