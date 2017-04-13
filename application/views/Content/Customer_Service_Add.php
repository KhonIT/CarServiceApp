<div ng-controller="cusServiceController" >
  <div class="col-sm-1 "> </div>
  <div class="col-sm-10 ">

<div class="panel panel-inverse">
<div class="panel-heading text-center" ><h3 class="sub-header">รับรถ</h3> </div>
<div class="panel-body  table-responsive">
      <div class="alert hidden text-center  "  id="msgbox" >{{msg}}</div>
  				<table  class="table table-inverse"  >
        <tr>
          <td colspan="2" class="text-center">
            <input type="text" name="tb_car_regis_number" id="tb_car_regis_number"  ng-keypress="checkIfEnterKey($event)" ng-model="car_regis_number"   />

              <button type="button" class="btn btn-inverse data-search-cus   glyphicon glyphicon-search"  ng-click="car_search();">ค้นหาทะเบียนรถ</button>

          </td>
        </tr>
        <tr>
          <td class="text-right">ชื่อ :</td>
          <td>{{cus_name}}</td>
        </tr>
        <tr>
          <td class="text-right">เบอร์โทร</td>
          <td>{{cus_tel}}</td>
        </tr>
        <tr>
          <td class="text-right"> ทะเบียนรถ:</td>
          <td>{{car_regis_number}}</td>
        </tr>
        <tr>
          <td class="text-right">ยี่ห้อ:</td>
          <td>{{car_brand}}</td>
        </tr>
        <tr>
          <td class="text-right">รุ่น:</td>
          <td>{{car_model}}</td>
        </tr>
        <tr>
          <td class="text-right">สี</td>
          <td>{{car_color}}</td>
        </tr>
        <tr>
          <td class="text-right">ขนาดของรถ</td>
          <td>{{car_size}}</td>
        </tr>
       <tr>
         <td colspan="2" class="text-center"  id="choose_service">
          <span  class=' icon glyphicon glyphicon-wrench'  ng-click="servicelist();">การบริการ</span>

          <div class="col-sm-1 "> </div>
          <div class="col-sm-10 ">
            <div  ng-repeat="service in services " class="text-left">
              <span class="text-left">{{$index + 1}} : {{service.name}} ราคา {{service.price}}</span>
            </div>
          </div>
          <div class="col-sm-1 "> </div>
          </td>
        </tr>

        <tr>
          <td class="text-right"> ราคารวม</td>
          <td> {{total_price | currency:""}} บาท</td>
        </tr>
        <tr>
          <td class="text-right">หมายเหตุ :</td>
          <td>
            <input type="text" name="tb_comment" id="tb_comment" ng-model="comment"   />
          </td>
        </tr>
        <tr>
          <td class="text-right">บันทึก:</td>
           <td><span  class="glyphicon glyphicon-floppy-save data-save icon" ng-click="saveservice();"> </span></td>
        </tr>
      </table>
      <div class="alert hidden text-center"  id="msgbox" >{{msg}}</div>
    </div>
</div>
</div>
<div class="col-sm-1 "> </div>

  <div class='modal fade' id='modal_data_car' role='dialog'>
  	<div class='modal-dialog'>
  	<div  class='modal-content modal-inverse'>
      <div class='modal-header'   >
    <button type='button' class='close icon' data-dismiss='modal'>&times;</button>
        <h4><span class='glyphicon '></span>เพิ่มข้อมูลรถ</h4>
      </div>
  			<div class='modal-body  table-responsive'  >
          <table class="table-modal table table-inverse ">
            <tr>
              <td> ทะเบียนรถ:</td>
              <td ><input type="text"  ng-model="car_regis_number"   /></td>
            </tr>
            <tr>
                <td rowspan="2"> ยี่ห้อ:</td>
                <td  style="width:500px;"  class="text-left">
  <div class="col-sm-2 " ng-repeat="logo in logos" >
                     <img  ng-src="<?php echo base_url(); ?>Assets/Images/iconlogo/{{logo.img}}" style="margin:5px;" class="icon" alt="{{logo.name}}" ng-click="iconlogo_click(logo.name)" />
</div>

            </tr>
            <tr>
                <td  style="width:500px;"  class="text-left">
  <input type="text"   ng-model="car_brand"  />
</td>
            </tr>
            <tr>
                <td> รุ่น:</td>
                <td><input type="text"  ng-model="car_model" /></td>
            </tr>
            <tr>
                <td> สี</td>
                <td><input type="text"  ng-model="car_color" /></td>
            </tr>
            <tr>
                <td>ขนาดของรถ</td>
                <td><input type="text" ng-model="car_color" /></td>
            </tr>
            <tr>
                <td>ชื่อ :</td>
                <td class="text-left">
                    <input type="text" ng-model="cus_name"  />
                </td>
            </tr>
            <tr>
              <td> เบอร์โทร:</td>
              <td  ><input type="tel" ng-model="cus_tel" /></td>
            </tr>
            <tr>
              <td colspan='2' class="text-center">
                <span  class="glyphicon glyphicon-floppy-save save-data icon" ng-click="savecus();"></span>
              </td>
            </tr>
          </table>
  			</div>
  		</div>
  	</div>
  </div>

  <div class='modal fade' id='modal_data_service_detail' role='dialog'>
    <div class='modal-dialog'>
  	<div  class='modal-content modal-inverse'>
        <div class='modal-header'   >
			<button type='button' class='close icon' data-dismiss='modal'>&times;</button>
          <h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
        </div>
		<div class='modal-body text-center table-responsive' >
 			<table class="table-modal  table table-inverse ">
            <tbody id='tbody_list'>
              <tr   ng-repeat="serall in service_all ">
                <td class="text-center">{{$index + 1}}</td>

                <td class="text-left">
                <label class="icon"><input type="checkbox" id="service_detail" value="{{''+serall.service_id}}"  /> {{serall.service_name}}</label></td>

                <td class="text-left"><input type="text" class="inputtxt"  id="{{'price-'+serall.service_id}}"  value="{{serall.price}}"   />
                   <input type="text"  id="{{'name-'+serall.service_id}}" style="display: none;" value="{{serall.service_name}}"   /></td>
              </tr>

              <tr>
                <td colspan='3' class="text-center">
                  <span  class="glyphicon glyphicon-floppy-save save-data icon" style="font-size:50px;" ng-click="saveservice();"></span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<div class='modal fade' id='modal_data_car_list' role='dialog'>
    <div class='modal-dialog'>
  	<div  class='modal-content modal-inverse'>
        <div class='modal-header'   >
			<button type='button' class='close icon' data-dismiss='modal'>&times;</button>
          <h4><span class='glyphicon '></span>ข้อมูลรถ</h4>
        </div>
		<div class='modal-body text-center table-responsive' >
 			<table class="table-modal  table table-inverse  ">
       					<thead>
						<tr >
							<th  class=" text-center">#</th>
                <th>ทะเบียน</th>
                <th>จังหวัด</th>
                <th>ยี่ห้อ</th>
                <th>รุ่น</th>
                <th>สี</th>
                <th>ชื่อ</th>
                <th>เบอร์โทร</th>
							  <th class=" text-center">เลือก</th>
						</tr>
					</thead>
            <tbody id='tbody_list'>
              <tr  class="row-hover"  ng-repeat="car in  cars" ng-click="car_choose(car.car_id);">
                <td class="text-center">{{$index + 1}}</td>
                <td class="text-center" id="{{'car_regis_number_'+car.car_id}}">{{car.car_regis_number}}</td>
                <td class="text-center" id="{{'car_regis_province_'+car.car_id}}">{{car.car_regis_province}}</td>
                <td class="text-center" id="{{'car_brand_'+car.car_id}}">{{car.car_brand}}</td>
                <td class="text-center" id="{{'car_model_'+car.car_id}}">{{car.car_model}}</td>
                <td class="text-center" id="{{'car_color_'+car.car_id}}">{{car.car_color}}</td>
                <td class="text-center" id="{{'cus_name_'+car.car_id}}">{{car.cus_name}}</td>
                <td class="text-center" id="{{'cus_tel_'+car.car_id}}">{{car.cus_tel}}</td>
                <td class="text-center hidden" id="{{'car_size'+car.car_id}}">{{car.car_size}}</td>
                <td class="text-center hidden" id="{{'cus_id'+car.car_id}}">{{car.cus_id}}</td>
          <td class="text-center">เลือก</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
