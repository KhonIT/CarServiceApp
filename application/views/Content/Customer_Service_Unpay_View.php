<div ng-controller="cusServicesController" >
  <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

<div class="panel panel-inverse">
  <div class="panel-heading" align="center"><h3 class="sub-header">การใช้บริการ</h3> </div>
  <div class="panel-body">



      <div class="table-responsive" align="center">
            <table  class="table table-inverse"  >
                <thead>
                    <tr >
                      <th>ลำดับที่</th>
                      <th>ชื่อ</th>
                      <th>เบอร์โทร</th>
                      <th>ทะเบียน-ยี่ห้อ-รุ่น-สี</th>
                      <th>วันที่ใช้บริการ</th>
                      <th>แก้ไข</th>
                      <th>ชำระเงิน</th>
                      <th>ลบ</th>
                    </tr>
                </thead>
                <tbody id='tbody_list'>
                  <tr ng-repeat="cs in customer_service">
                  <td>{{i}}</td>
                  <td>{{cs.cus_name}}</td>
                  <td>{{cs.cus_tel}}</td>
                  <td>{{cs.car_regis_number}}-{{cs.car_brand}}-{{cs.car_model}}-{{cs.car_color}}</td>
                  <td>{{cs.receipt_date }}</td>
                  <td align="center"><span class="glyphicon glyphicon-option-horizontal edit-data icon"  ng-click="EditCusService(cs.id)"></span></td>
                  <td align="center"><span class="glyphicon glyphicon-print  icon " target="_blank" ng-click="confirm_print(cs.id)"  ></span></td>
                  <td align="center"><span class="glyphicon glyphicon-remove remove-data icon "  ng-click="removeCusService(cs.id)" ></span></td></tr>
                </tbody>
            </table>
        </div>
          </div>
</div>

    </div>
    <div class="col-sm-2 "> </div>

<div class='modal fade' id='modal_popup_detail_order' role='dialog'>
	<div class='modal-dialog'>
		<div  class='modal-content  modal-inverse'>
			<div class='modal-header'  align="center">
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลรายละเอียดการบริการ</h4>
			</div>
			<div class='modal-body'  align="center"   >
				<table class="table-modal table table-inverse ">
					       <thead>
                    <tr >
                        <th>ลำดับที่</th>
		                    <th>บริการ</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
					<tbody id='tbody_details_service_list'>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class='modal fade' id='modal_data' role='dialog'>
	<div class='modal-dialog'>
	<div  class='modal-content modal-inverse'>
		<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal'>&times;</button>
			<h4><span class='glyphicon '></span>ข้อมูลผู้ใช้</h4>
		</div>
		<div class='modal-body' align='center'  >
			<table class="table-modal table table-inverse ">
        <tr>
          <td> ข้อมูล ลูกค้า </td>
          <td>
              <span class='data-cus' >ชื่อ-เบอร์โทร-ทะเบียน-ยี่ห้อ-รุ่น-สี</span>
              <span class='data-edit-cus icon ' id=''>แก้ไข</span>
              <span class='data-add-cus icon glyphicon glyphicon-plus' id=''>เพิ่ม</span>
              <span class='data-search-cus icon glyphicon glyphicon-search' id=''>ค้นหา</span>
          </td>
        </tr>
        <tr>
          <td> ใบเสร็จเล่มที่</td>
          <td> <input type="number" name="tb_book_no" id="tb_book_no"   />
                <input type="text" name="tb_id" id="tb_id" style="display: none;"   />
                <input type="text" name="tb_cus_id" id="tb_cus_id" style="display: none;"   />
          </td>
        </tr>

        <tr>
          <td> ใบเสร็จเลขที่</td>
          <td> <input type="number" name="tb_number" id="tb_number"   /></td>
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
					<td>บันทึก:</td>
					 <td><span  class="glyphicon glyphicon-floppy-save data-save icon"></span></td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>

<div class='modal fade' id='modal_data_cus' role='dialog'>
	<div class='modal-dialog'>
		<div  class='modal-content modal-inverse'>
			<div class='modal-header'  align="center">
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลลูกค้า</h4>
			</div>
			<div class='modal-body'  align="center"   >
        <table class="table-modal table table-inverse ">
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




<div class='modal fade' id='modal_data_cus_search' role='dialog'>
	<div class='modal-dialog'>
		<div  class='modal-content modal-inverse'>
			<div class='modal-header'  align="center">
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลรายละเอียดการบริการ</h4>
			</div>
			<div class='modal-body'  align="center"   >
        <table class="table-modal   table table-inverse ">
          <tr>
            <td> เบอร์โทร:</td>
            <td><input type="tel" name="tb_cus_tel_search" id="tb_cus_tel_search"  /></td>
          </tr>
          <tr>
            <td> ทะเบียนรถ:</td>
            <td><input type="text" name="tb_cus_car_number_search" id="tb_cus_car_regis_number_search"  /></td>
          </tr>
          <tr>
            <td colspan='2' class="text-center">
              <span  class="glyphicon glyphicon-search search-data icon"></span>
            </td>
          </tr>
        </table>

        <table class="table-modal " >
					       <thead>
                    <tr >
                      <th>ชื่อ</th>
                      <th>เบอร์โทร</th>
                      <th>ทะเบียน</th>
                      <th>ยี่ห้อ</th>
                      <th>รุ่น</th>
                      <th>สี</th>
                      <th>เลือก</th>
                    </tr>
                </thead>
					<tbody id='tbody_cus_list'>

					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
</div>