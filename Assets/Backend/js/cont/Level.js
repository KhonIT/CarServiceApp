app.controller('levelController', function($scope, $http, $timeout) {

    $scope.level = []; //declare an empty array
    $scope.permission = []; //declare an empty array
    //declare empty
    $scope.l_id = "";
    $scope.l_name =  "";
    $scope.l_parent_id = "";
    $scope.msg="";


    $http.get(backend_url + 'Level/Get_All').success(function(response) {
        $scope.level = response;//ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $scope.getData = function() {
        $http.get(backend_url + 'Level/Get_All').success(function(response) {
            $scope.level = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
        })
    }

    $scope.sort = function(keyname) {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }



    $scope.inslevel = function() {
      $scope.headermsg = "เพิ่มข้อมูล";
      $scope.l_id = "0";
      $scope.l_name =  "";
      $scope.l_parent_id = "";
      $("#modal_data").modal();
    }

    $scope.editlevel = function(id) {
        $scope.headermsg = "แก้ไขข้อมูล";
        $http.post(backend_url + 'Level/Get_By_ID', { 'id': id })
            .success(function(data) {
                $scope.l_id = data.l_id;
                $scope.l_name =  data.l_name;
                $scope.l_parent_id =  data.l_parent_id;
                $("#modal_data").modal();
            }).error(function(err) {
                console.log(err);
            })
    }
    $scope.editpermission = function(id) {
        $scope.headermsg = "แก้ไขข้อมูลสิทธิ์การเข้าถึง";
        $http.post(backend_url + 'Permission/Get_By_ID', { 'id': id })
            .success(function(data) {
              $scope.l_id = id;
              $scope.permission  = data  ; 
                $("#modal_permission").modal();
            }).error(function(err) {
                console.log(err);
            })
    }



        $scope.savepermission = function() {
          var  jsonObj = [];
          $('input:checkbox[id^="menuid_"]').each(function(){
              //alert($(this).val()+":"+$(this).prop("checked")+":"+$("#"+$(this).attr("id")).parent().attr("id"));
                  data = {}
                  data["l_id"] =   $scope.l_id ;
                  data["menu_id"] = $(this).val();
                  data["is_edit"] = $(this).prop("checked");
                  data["permission_id"] = $("#"+$(this).attr("id")).parent().attr("id");
                  jsonObj.push(data);

          });
          var jsonpost = JSON.stringify(jsonObj) 
            $http.post(backend_url + 'Permission/Edit', {'jsonObj': jsonpost})
                .success(function(data) { 
                  $('#modal_permission').modal('toggle');
                  if (angular.equals(data, "true")  ){
                      $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";
                      $scope.displaymsgsuccess();
                  }else{
                    $scope.msg ="บันทึ่กขึ้อมูลไม่สำเร็จ";
                    $scope.displaymsgwarning();
                  }

                }).error(function(err) {
                    console.log(err);
                })
        }

    $scope.savedata = function() {
       //for-debug
       //console.log($scope.cus_id+':'+$scope.cus_name);
        $http.post(backend_url + 'Level/Edit', {id: $scope.l_id, l_name: $scope.l_name, l_parent_id: $scope.l_parent_id})
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
    $scope.dellevel = function(id) {
        var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
        if (r == true) {
            $http.post(backend_url + 'Level/Delete', { 'id': id })
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
