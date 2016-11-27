    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 " ng-app="App">

<div class="panel panel-default" ng-controller="customerController" >
  <div class="panel-heading text-center" ><h3 class="sub-header">รายชื่อลูกค้า</h3> </div>
  <div class="panel-body">

     <div align="right" class="green "   >



             				<form class="form-inline">
             					<div class="form-group">
             						<label >Search</label>
                        <input type ='text' class="form-control" placeholder="ระบุชื่อหรือนามสกุล เพื่อค้นหา" ng-model="search" />
             					</div>
             				</form>
                  <!--  <div align="left"  class="alert alert-info">
                     <p>Sort key: {{sortKey}}</p>
                     <p>Reverse: {{reverse}}</p>
                     <p>Search String : {{search}}</p>
                    </div>
                    -->
   <span class="add-data u icon">เพิ่ม</span>
   <span class="add-data glyphicon glyphicon-plus icon"></span>
	 </div>
  </div>

  <!-- Table -->
      <div class="table-responsive text-center"  >

        <table  class="table table-striped">
          <tr class="text-center">
            <th>ลำดับที่</th>
            <th ng-click="sort('cus_name')">ชื่อ</th>
            <th ng-click="sort('cus_tel')">เบอร์โทร</th>
            <th ng-click="sort('cus_car_regis_number')">ทะเบียน</th>
            <th ng-click="sort('cus_car_brand')">ยี่ห้อ</th>
            <th ng-click="sort('gender')">รุ่น</th>
            <th ng-click="sort('cus_car_color')">สี</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
          </tr>
          <tr class="tbody_list" ng-repeat="cus in customers |orderBy:sortKey:reverse|filter:search">
            <td class="text-center">{{$index + 1}}</td>
            <td class="text-left">{{cus.cus_name}}</td>
            <td class="text-left">{{cus.cus_tel}}</td>
            <td class="text-left">{{cus.cus_car_regis_number}}</td>
            <td class="text-left">{{cus.cus_car_brand}}</td>
            <td class="text-left">{{cus.cus_car_model}}</td>
            <td class="text-left">{{cus.cus_car_color}}</td>
            <td class=" text-center"><span class="glyphicon glyphicon-option-horizontal edit-data icon " ng-click="editcus(cus.id);"></span></td>
            <td class=" text-center"><span class="glyphicon glyphicon-remove remove-data icon " ng-click="delcus(cus.id);"></span></td>
          </tr>
        </table>
      </div>
</div>



    </div>
    <div class="col-sm-1 "> </div>

<div class='modal fade' id='modal_data' role='dialog'>
	<div class='modal-dialog'>
		<div  class='modal-content'>
			<div class='modal-header text-center'  >
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลรายละเอียดลูกค้า</h4>
			</div>
			<div class='modal-body text-center'   >
        <table class="table-modal " >
          <tr>
              <td>ชื่อ :</td>
              <td>
                  <input type="text" name="tb_cus_name" id="tb_cus_name"   />
                  <input type="text" name="tb_id" id="tb_id" style="display: none;"   />
              </td>
          </tr>
          <tr>
            <td> เบอร์โทร:</td>
            <td><input type="tel" name="tb_cus_tel" id="tb_cus_tel"  /></td>
          </tr>
          <tr>
            <td> ทะเบียนรถ:</td>
            <td><input type="text" name="tb_cus_car_number" id="tb_cus_car_regis_number"  /></td>
          </tr>
          <tr>
              <td> ยี่ห้อ:</td>
              <td><input type="text" name="tb_cus_car_brand" id="tb_cus_car_brand"   /></td>
          </tr>
          <tr>
              <td> รุ่น:</td>
              <td><input type="text" name="tb_cus_car_model" id="tb_cus_car_model"   /></td>
          </tr>
          <tr>
              <td> สี</td>
              <td><input type="text" name="tb_cus_car_color" id="tb_cus_car_color"   /></td>
          </tr>
          <tr>
            <td colspan='2' class="text-center">
              <span  class="glyphicon glyphicon-floppy-save save-data icon"></span>
            </td>
          </tr>
        </table>
			</div>
		</div>
	</div>
</div>
