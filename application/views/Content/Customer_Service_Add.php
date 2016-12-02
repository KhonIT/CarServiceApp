<div ng-controller="cusServiceController" >
  <div class="col-sm-1 "> </div>
  <div class="col-sm-10 ">

<div class="panel panel-default" >
<div class="panel-heading text-center" ><h3 class="sub-header">รับรถ</h3> </div>
<div class="panel-body">

    <div align="left"  class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
<!-- Table -->
      <table  class="table  table-responsive   table-strip table-hover">
        <tr>
          <td> ข้อมูล ลูกค้า </td>
          <td>
            <span class='data-search-cus icon glyphicon glyphicon-search'  ng-click="addcus()">ค้นหา</span>
            <p class="text-left">{{cus_name}}</p>
            <p class="text-left">{{cus_tel}}</td>
            <p class="text-left">{{cus_car_regis_number}}</p>
            <p class="text-left">{{cus_car_brand}}</p>
            <p class="text-left">{{cus_car_model}}</p>
            <p class="text-left">{{cus_car_color}}</p>
          </td>
        </tr>
        <tr>
          <td>รายละเอียดการบริการ</td>
          <td>
            <table class="table-modal" id='table_order_detail'>
            </table>
          </td>
        </tr>

        <tr>
          <td> ราคารวม</td>
          <td> <input type="number" name="tb_total" id="tb_total"   /></td>
        </tr>
        <tr>
          <td>หมายเหตุ :</td>
          <td>
            <input type="text" name="tb_comment" id="tb_comment"   />
          </td>
        </tr>
        <tr>
          <td>สถานะการชำระเงิน:</td>
          <td>
            <select   id='dd_pay_status' >
                <option value='0' selected="selected">ยังไม่ได้ชำระเงิน</option>
                <option value='1'>ชำระเงินแล้ว</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>บันทึก:</td>
           <td><span  class="glyphicon glyphicon-floppy-save data-save icon"></span></td>
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
  			<div class='modal-body  '   >
          <table class="table-modal " >
            <tr>
                <td>ชื่อ :</td>
                <td>
                    <input type="text" name="tb_cus_name" id="tb_cus_name"  ng-model="cus_name"  />
                    <input type="text" name="tb_id" id="tb_id" style="display: none;" ng-model="cus_id"   />
                </td>
            </tr>
            <tr>
              <td> เบอร์โทร:</td>
              <td><input type="tel" name="tb_cus_tel" id="tb_cus_tel" ng-model="cus_tel" /></td>
            </tr>
            <tr>
              <td> ทะเบียนรถ:</td>
              <td><input type="text" name="tb_cus_car_number" id="tb_cus_car_regis_number" ng-model="cus_car_regis_number"   /></td>
            </tr>
            <tr>
                <td> ยี่ห้อ:</td>
                <td  style="width:500px;"  class="text-left">

                     <img ng-repeat="logo in logos" ng-src="<?php echo base_url(); ?>Assets/Images/iconlogo/{{logo.img}}" style="margin:5px;" class="icon" alt="{{logo.name}}" ng-click="iconlogo_click(logo.name)" />

                 <p>  อื่นๆ : <input type="text" name="tb_cus_car_brand" id="tb_cus_car_brand"  ng-model="cus_car_brand"  /></p></td>
            </tr>
            <tr>
                <td> รุ่น:</td>
                <td><input type="text" name="tb_cus_car_model" id="tb_cus_car_model"  ng-model="cus_car_model" /></td>
            </tr>
            <tr>
                <td> สี</td>
                <td><input type="text" name="tb_cus_car_color" id="tb_cus_car_color"  ng-model="cus_car_color" /></td>
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




  <div class='modal fade' id='modal_data_cus_search' role='dialog'>
  	<div class='modal-dialog'>
  		<div  class='modal-content'>
  			<div class='modal-header'  align="center">
  				<button type='button' class='close' data-dismiss='modal'>&times;</button>
  				<h4><span class='glyphicon '></span>ข้อมูลลูกค้า</h4>
          <span class='data-add-cus icon glyphicon glyphicon-plus' ng-click="addcus()">เพิ่ม</span>
  			</div>
  			<div class='modal-body'  align="center"   >
          <table class="table-modal " >
  					       <thead>
                     <tr class="text-center">
                       <th>ลำดับที่</th>
                       <th ng-click="sort('cus_name')">ชื่อ</th>
                       <th ng-click="sort('cus_tel')">เบอร์โทร</th>
                       <th ng-click="sort('cus_car_regis_number')">ทะเบียน</th>
                       <th ng-click="sort('cus_car_brand')">ยี่ห้อ</th>
                       <th ng-click="sort('gender')">รุ่น</th>
                       <th ng-click="sort('cus_car_color')">สี</th>
                       <th>เลือก</th>
                     </tr>

                  </thead>
  					<tbody id='tbody_cus_list'>
              <tr class="tbody_list" ng-repeat="cus in customers |orderBy:sortKey:reverse|filter:search">
                <td class="text-center">{{$index + 1}}</td>
                <td class="text-left">{{cus.cus_name}}</td>
                <td class="text-left">{{cus.cus_tel}}</td>
                <td class="text-left">{{cus.cus_car_regis_number}}</td>
                <td class="text-left">{{cus.cus_car_brand}}</td>
                <td class="text-left">{{cus.cus_car_model}}</td>
                <td class="text-left">{{cus.cus_car_color}}</td>
              <td align="center"><span class="glyphicon glyphicon-share-alt choose-data icon " ng-click="choosecus(cus.id);"id='+obj.id+'></span></td>
              </tr>
  					</tbody>
  				</table>

  			</div>
  		</div>
  	</div>
  </div>

</div>
