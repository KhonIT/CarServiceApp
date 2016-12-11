    <div ng-controller="serviceController" >
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

      <div class="panel panel-default">
        <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อการบริการ</h3> </div>
        <div class="panel-body">
           <div align="right" class="green "  id="icon_add" >
      		<span class="add-data u icon"  ng-click="ins();">เพิ่ม</span>
      		<span class="glyphicon glyphicon-plus  add-data icon"  ng-click="ins();"></span>
      	 </div>
                      <div align="left"  class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
        <!-- Table -->
            <div class="table-responsive" align="center">
                  <table  class="table_head table-striped"  >
                      <thead>
                          <tr >
                              <th>ลำดับที่</th>
                              <th>การบริการ</th>
                              <th>แก้ไข</th>
                              <th>ลบ</th>
                          </tr>
                      </thead>
                      <tbody id='tbody_list'>
                      <tr  ng-repeat="obj in services" >
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">{{obj.service_name}}</td>
                        <td align="center"><span class="glyphicon glyphicon-option-horizontal edit-data icon " ng-click="edit(obj.service_id);"></span></td>
                        <td align="center"><span class=" glyphicon glyphicon-remove remove-data icon " ng-click="del(obj.service_id);"></span></td></tr>
                      </tbody>
                  </table>
              </div>
      </div>

      </div>
    </div>
    <div class="col-sm-1 "> </div>

	<div class='modal fade' id='modal_data' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
			</div>
			<div class='modal-body' >
				<table class="table-modal">
					<tr>
						<td>การบริการ :</td>
						<td>
							<input type="text" name="tb_name" id="tb_name"  ng-model="service_name"  />
							<input type="text" name="tb_id" id="tb_id" style="display:none;"  ng-model="service_id"  />
						</td>
						<td rowspan='2'><span  class="glyphicon glyphicon-floppy-save save-data icon"  ng-click="save()"></span> </td>
					</tr>
					<tr>
						<td>ราคา :</td>
						<td><input type="text" name="tb_price" id="tb_price"  ng-model="price"  /> </td>
					</tr>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>
