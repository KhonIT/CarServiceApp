    <div ng-controller="serviceController" id="top-panel">
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

      <div class="panel panel-inverse">
        <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อการบริการ</h3> </div>
        <div class="panel-body">
           <div align="right" class="green "  id="icon_add" >
      		<span class="add-data u icon"  ng-click="ins();">เพิ่ม</span>
      		<span class="glyphicon glyphicon-plus  add-data icon"  ng-click="ins();"></span>
      	 </div>
     <div class="panel-body table-responsive text-center">
        <div align="left"  class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
        <!-- Table -->
        
           		<table  class="table table-inverse"  >
                      <thead>
                          <tr >
                              <th  class=" text-center">#</th>
                              <th>การบริการ</th>
                              <th>ราคา</th>
                              <th class=" text-center">บันทึก</th>
                              <th class=" text-center">ลบ</th>
                          </tr>
                      </thead>
                      <tbody id='tbody_list'>
                      <tr  ng-repeat="obj in services" >
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">
	                           <input type="text" name="tb_name_{{''+obj.service_id}}" id="tb_name_{{''+obj.service_id}}"  ng-model="obj.service_name"  />
                        </td>
                        <td class="text-left">
                             <input type="text" name="tb_price_{{''+obj.service_id}}" id="tb_price_{{''+obj.service_id}}"  ng-model="obj.price"  />
                        </td>
                        <td align="center"><span class="glyphicon glyphicon-floppy-save icon " ng-click="save(obj.service_id);"></span></td>
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
		<div  class='modal-content  modal-inverse'>
			<div class='modal-header'>
				<button type='button' class='close icon' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
			</div>
			<div class='modal-body text-center' >
			<table class="table-modal  table table-inverse ">
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
