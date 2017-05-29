app.controller('cusServiceController', function($scope, $http, $timeout) {
    $scope.logos = []; //declare an empty array
    $scope.services = []; //declare an empty array
    $scope.service_all = []; //declare an empty array
    $scope.cars = []; //declare an empty array
    //declare empty
    $scope.car_id = "";
    $scope.car_regis_number = "";
    $scope.car_regis_province =  "";
    $scope.car_brand =  "";
    $scope.car_model =  "";
    $scope.car_color = "";
    $scope.car_size = "";
    $scope.total_price = "";

    $scope.cus_id = "";
    $scope.cus_name =  "";
    $scope.cus_tel = "";

    $scope.comment  = "";
    $scope.msg = "";

    $("#choose_service").addClass("hidden");

    $http.get(backend_url + 'Customer/Get_Logo').success(function(response) {
        $scope.logos = response; //ajax request to fetch data into $scope.data
    }).error(function(err) {
        console.log(err);
    });

    $scope.GetService = function() { 
      $http.post(backend_url + 'Services/Get_By_Car_Size', { 'car_size': $scope.car_size }).success(function(response) {
      $scope.service_all = response; //ajax request to fetch data into $scope.data
      $("#choose_service").removeClass("hidden"); 
      }).error(function(err) {
          console.log(err);
      });
    }


    $scope.servicelist = function() {
      $('#modal_data_service_detail').modal();
    }

    $scope.iconlogo_click = function(iconname) {
      $scope.car_brand =  iconname;
    }

    $scope.addcar = function () {
        $scope.car_id = "0";
        $scope.car_regis_province =  "";
        $scope.car_brand =  "";
        $scope.car_model =  "";
        $scope.car_color = "";
        $scope.car_size = "";
        $scope.total_price = "";

        $scope.cus_id = "0";
        $scope.cus_name =  "";
        $scope.cus_tel = "";
        $('#modal_data_car').modal();
    }

    $scope.savecar = function() {
       //for-debug
       //console.log($scope.cus_id+':'+$scope.cus_name);
        $('#modal_data_car').modal('hide');
        $http.post(backend_url + 'Customer/Edit', {car_id:$scope.car_id,car_regis_number: $scope.car_regis_number,car_regis_province: $scope.car_regis_province, car_brand: $scope.car_brand, car_model: $scope.car_model, car_color:$scope.car_color, car_size:$scope.car_size,cus_id: $scope.cus_id, cus_name: $scope.cus_name, cus_tel: $scope.cus_tel })
            .success(function(data) {
              if (angular.equals(data, "true")  ){
                  $scope.msg ="เพิ่มข้อมูลสำเร็จ";
                  $scope.displaymsgsuccess();
              }else{
                $scope.msg ="บันทึ่กขึ้อมูลไม่สำเร็จ";
                $scope.displaymsgwarning();
              }
            }).error(function(err) {
                console.log(err);
            })
    }

    $scope.cal_service = function() {
      $scope.services = [];
      var sum =parseFloat(0.00);
      $('input:checkbox[id^="service_detail"]').each(function(){
                if($(this).prop("checked")){
                sum+= parseFloat($("#price-"+$(this).val()).val());
                    var obj = { service_id: $(this).val() ,name:  $("#name-"+$(this).val()).val(),price: $("#price-"+$(this).val()).val(),is_show : '1'};
                    $scope.services.push(obj);
                }
      });
         $scope.total_price = parseFloat(sum) ;
          $('#service_detail').removeClass("hidden");
          $('#modal_data_service_detail').modal('hide');
    }



	$scope.saveservice = function() {
				//for-debug
				//console.log($scope.cus_id+':'+$scope.total_price);
				//console.log( $scope.services.length);

		if (angular.equals($scope.car_id , "")  ){
			$scope.msg ="กรุณากรอกข้อมูลทะเบียนรถ";
			$scope.displaymsgwarning();
		}else  if ($scope.services.length < 1 ){
			$scope.msg ="กรุณาเลือกบริการ";
			$scope.displaymsgwarning();
			$('#modal_data_service_detail').modal();
		}else{
			$http.post(backend_url + 'Customer_Service/AddService', {
				car_id: $scope.car_id,
				total_price: $scope.total_price,
				comment: $scope.comment,
				services: JSON.stringify($scope.services),
			  }).success(function(data) {
				  $('#modal_data').modal('hide');
				  if (angular.equals(data, "true")) {
					   //clear
					  $scope.services = [];
					  $scope.service_all = [];

					  $scope.cus_id = "";
					  $scope.cus_name =  "";
					  $scope.cus_tel = "";
					  $scope.car_id = "";
					  $scope.car_regis_number = "";
					  $scope.car_regis_province =  "";
					  $scope.car_brand =  "";
					  $scope.car_model =  "";
					  $scope.car_color = "";
					  $scope.car_size = "";

					  $scope.total_price = "";
					  $scope.comment  = "";

					  $scope.msg ="บันทึ่กขึ้อมูลเรียบร้อย";
					  $scope.displaymsgsuccess();
					  $("#choose_service").addClass("hidden");

				  }else{
					$scope.msg ="บันทึ่กขึ้อมูลไม่สำเร็จ";
					$scope.displaymsgwarning();
				  }
				}).error(function(err) {
					console.log(err);
				})
		}
	} 
    $scope.car_search = function () {
      if ( $scope.car_regis_number.length<4  ){
        $scope.msg ="กรุณากรอกข้อมูลทะเบียนรถอย่างน้อย 4 ตัวอักษร";
        $scope.displaymsgwarning();
      }else{
        $http.post(backend_url + 'Customer/Get_By_CarRegisNumber', { 'car_regis_number': $scope.car_regis_number })
            .success(function (data) {
                $scope.cars = data;
                if ($scope.cars.length == 0) {
                   $scope.addcar();
              /*  }else if ($scope.cars.length == 1) {
                    $scope.cus_id = data[0].cus_id;
                    $scope.cus_name = data[0].cus_name;
                    $scope.cus_tel = data[0].cus_tel;
                    $scope.car_id = data[0].car_id;
                    $scope.car_regis_number = data[0].car_regis_number;
                    $scope.car_regis_province = data[0].car_regis_province;
                    $scope.car_brand = data[0].car_brand;
                    $scope.car_model = data[0].car_model;
                    $scope.car_color = data[0].car_color;
                    $scope.car_size = data[0].car_size;
                    $scope.GetService();
                    */
                } else {
                      $('#modal_data_car_list').modal();
                }

            }).error(function(err) {
                console.log(err);
            })
      }

    }
    $scope.car_choose= function(id){
      $scope.cus_name = $('#cus_name_'+id).text();
      $scope.cus_tel = $('#cus_tel_'+id).text();
      $scope.car_id = id;
      $scope.cus_id = $('#cus_id_'+id).text();
      $scope.car_regis_number = $('#car_regis_number_'+id).text();
      $scope.car_regis_province = $('#car_regis_province_'+id).text();
      $scope.car_brand  = $('#car_brand_'+id).text();
      $scope.car_model = $('#car_model_'+id).text();
      $scope.car_color = $('#car_color_'+id).text();
      $scope.car_size = $('#car_size_'+id).text();
      $('#modal_data_car_list').modal('hide');
      $scope.GetService();
    }


    $scope.checkIfEnterKey = function($event){
      var keyCode = $event.which || $event.keyCode;
      //Debug console.log(keyCode);
        if (keyCode === 13) {
                    $scope.car_search();
        }
    }
    $scope.displaymsgsuccess = function(){
      $('.msgbox').addClass( "alert-success" ).removeClass( "alert-warning hidden");
      $timeout(function() {
           $('.msgbox').addClass( "hidden" )
        }, 2000); // delay 1500 ms
    }
    $scope.displaymsgwarning = function(){
      $('.msgbox').addClass( "alert-warning" ).removeClass( "alert-success hidden" );
      $timeout(function() {
           $('.msgbox').addClass( "hidden" )
        }, 2000); // delay 1500 ms
    }
});
