app.controller('cusServiceController', function($scope, $http, $timeout) {

  $scope.customers = []; //declare an empty array
  $scope.logos = []; //declare an empty array
  //declare empty
  $scope.cus_id = "";
  $scope.cus_name =  "";
  $scope.cus_tel = "";
  $scope.cus_car_regis_number =  "";
  $scope.cus_car_brand =  "";
  $scope.cus_car_model =  "";
  $scope.cus_car_color = "";
  $scope.msg="";

    $scope.msg="";
    $http.get(backend_url + 'Customer/Get_All').success(function(response) {
        $scope.customers = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });



    $scope.savecusservice = function() {
       //for-debug
       //console.log($scope.emp_id+':'+$scope.emp_name);
/*
var  jsonObj = [];
var sum = parseFloat("0.00");
    $('input:checkbox[id^="service_"]').each(function(){
    data = [];
    data["order_id"] = $("#tb_id").val();
    data["order_detail_id"] =  $(this).attr('id').replace("service_", "");;
    data["service_id"] = $(this).val();
    data["is_show"] = $(this).prop("checked");
    data["price"] = $("#price-"+$(this).val()).val();
    if($(this).prop("checked")){
    sum+= parseFloat($("#price-"+$(this).val()).val());
}
jsonObj.push(data);


$.ajax({
  url: backend_url+'Customer_Service/Get_OrdersDetails_By_ID',
  data: { id:data.id},
  cache:false,
  type: "POST",
  dataType: "json",
  success: function (result)
  {
    $("#table_order_detail").text("");
    var i = 1;
    var sum = parseFloat("0.00");
    var html ="";
    $.each(result, function(idx, obj) {
      if(obj.order_detail_id != "0"){
        html= '<tr><td align="center">'+i+'</td><td   ><input type="checkbox" id="service_'+obj.order_detail_id+'" checked="checked" value="'+obj.service_id+'"  /> '+obj.service_name+' : <input type="number" id="price-'+obj.service_id+'" value="'+obj.price+'"   /> </td> </tr>';
      }else{
        html= '<tr><td align="center">'+i+'</td><td  "><input type="checkbox" id="service_'+obj.order_detail_id+'" value="'+obj.service_id+'"   />'+obj.service_name+' : <input type="number" id="price-'+obj.service_id+'" value="'+obj.service_price+'"   /> </td> </tr>';
      }
     $("#table_order_detail").append(html);
      sum+= parseFloat(obj.price);
      i++;
    });
  }
});
$("#m
});
*/
        $http.post(backend_url + 'Employee/Edit', {
            id: $scope.emp_id,
            emp_name: $scope.emp_name,
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
