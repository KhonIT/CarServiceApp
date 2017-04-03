

app.controller('employeeController', function($scope, $http, $timeout) {

    $scope.employees = []; //declare an empty array
    //declare empty
    $scope.emp_id = "";
    $scope.emp_st_name =  "";
    $scope.emp_fname = "";
    $scope.emp_lname = "";
    $scope.emp_nickname = "";
    $scope.emp_tel =  "";
    $scope.emp_passport =  "";
    $scope.emp_address =  "";
    $scope.emp_startwork =  "";
    $scope.emp_picture =  "";
    $scope.emp_oldwork =  "";
    $scope.emp_degree =  "";
    $scope.emp_nationality =  "";
    $scope.emp_l_id = "";
    $scope.emp_current_salary = parseFloat("0.00");
    $scope.emp_username =  "";
    $scope.emp_password =  "";

    $scope.msg="";
    $http.get(backend_url + 'Employee/Get_All').success(function(response) {
        $scope.employees = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $http.get(backend_url + 'Level/Get_All').success(function(response) {
      angular.forEach(response, function(value, key) {
        	//console.log( key : value['l_id']+ ':' + value['l_name']);
        $("#dd_Level").append('<option value='+value['l_id']+'>'+value['l_name']+'</option>');
      });
    }).error(function(err) {
        console.log(err);
    });

    $scope.getData = function() {
        $http.get(backend_url + 'Employee/Get_All').success(function(response) {
            $scope.employees = response; //ajax request to fetch data into $scope.data
        }).error(function(err) {
            console.log(err);
        })
    }
    $scope.sort = function(keyname) {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.delemp = function(id) {
        console.log(id);
        var r = confirm("ยืนยันการลบข้อมูล รายการนี้ ?");
        if (r == true) {
            $http.post(backend_url + 'Employee/Delete', { 'id': id })
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

    $scope.insemp = function() {
        $scope.emp_id = "0";
        $scope.emp_st_name =  "";
        $scope.emp_fname = "";
        $scope.emp_lname = "";
        $scope.emp_nickname = "";
        $scope.emp_tel =  "";
        $scope.emp_passport =  "";
        $scope.emp_address =  "";
        $scope.emp_startwork =  "";
        $scope.emp_picture =  "";
        $scope.emp_oldwork =  "";
        $scope.emp_degree =  "";
        $scope.emp_nationality =  "";
        $scope.emp_current_salary =  "";
        $scope.emp_username =  "";
        $scope.emp_password =  ""; 
        $("#modal_data").modal();
    }



    $scope.editemp = function(id) { 
        $http.post(backend_url + 'Employee/Get_By_ID', { 'id': id })
            .success(function (data) {
                        console.log(data);
                $scope.emp_id = data.emp_id;
                $scope.emp_st_name =  data.emp_st_name;
                $scope.emp_fname = data.emp_fname;
                $scope.emp_lname =  data.emp_lname;
                $scope.emp_nickname = data.emp_nickname;
                $scope.emp_tel =  data.emp_tel;
                $scope.emp_passport =  data.emp_passport;
                $scope.emp_address =  data.emp_address;
                $scope.emp_startwork =  data.emp_startwork;
                $scope.emp_picture =  data.emp_picture;
                $scope.emp_oldwork =  data.emp_oldwork;
                $scope.emp_degree =  data.emp_degree;
                $scope.emp_nationality =  data.emp_nationality;
                $scope.emp_current_salary =   parseFloat(data.emp_current_salary);
                $scope.emp_username =  data.emp_username;
                $scope.emp_password =  data.emp_password;
                $("#dd_Level").val(data.emp_l_id);
                $("#modal_data").modal();
            }).error(function(err) {
                console.log(err);
            })
    }

    $scope.saveemp = function() {
       //for-debug
       //console.log($scope.emp_id+':'+$scope.emp_name);
        $http.post(backend_url + 'Employee/Edit', {
            id: $scope.emp_id,
            emp_st_name: $scope.emp_st_name,
            emp_fname: $scope.emp_fname,
            emp_lname: $scope.emp_lname,
            emp_nickname: $scope.emp_nickname,
            emp_tel: $scope.emp_tel,
            emp_passport: $scope.emp_passport,
            emp_address: $scope.emp_address,
            emp_startwork: $scope.emp_startwork,
            emp_picture: $scope.emp_picture,
            emp_oldwork: $scope.emp_oldwork,
            emp_degree: $scope.emp_degree,
            emp_nationality: $scope.emp_nationality,
            emp_current_salary: $scope.emp_current_salary,
            emp_username: $scope.emp_username,
            emp_password: $scope.emp_password,
            emp_l_id:$('#dd_Level :selected').val()
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


});
