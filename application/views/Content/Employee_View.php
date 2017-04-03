
    <div ng-controller="employeeController" >
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">
		<div class="panel panel-inverse">
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อพนักงาน</h3> </div>
		  <div class="panel-body">
        <div  class="  darkgray text-right "  id="icon_add_employee"  >
          <label for="searchtxt" class="sr-only">ค้นหา</label>
          <input type ='text' class="inputtxt" id="searchtxt" placeholder="ค้นหา" ng-model="search" />
          <span class="glyphicon glyphicon-plus  employee-add icon" ng-click="insemp();">เพิ่ม</span>
        </div>
      </div>
		<div class="panel-body  table-responsive" align="center">
			<div align="left"  class="alert  hidden text-center"  id="msgbox" > {{msg}} </div>
				<table  class="table table-inverse"  >
					<thead>
						<tr >
							<th  class=" text-center">#</th>
							<th>ชื่อ - นามสกุล</th>
							<th>ชื่อเล่น</th>
							<th>ตำแหน่ง</th>
							<th class=" text-center">แก้ไข</th>
							<th class=" text-center">ลบ</th>
						</tr>
					</thead>
					<tbody id='tbody_data'>
					<tr class="tbody_list" ng-repeat="emp in employees |orderBy:sortKey:reverse|filter:search"  >
						<td class="text-center">{{$index + 1}}</td>
						<td class="text-left">{{emp.name}}</td>
						<td class="text-left">{{emp.emp_nickname}}</td>
						<td class="text-left">{{emp.l_name}}</td>
						<td class=" text-center"><span class="glyphicon glyphicon-wrench edit-data icon " ng-click="editemp(emp.emp_id);"></span></td>
						<td class=" text-center"><span class="glyphicon glyphicon-remove-sign remove-data icon " ng-click="delemp(emp.emp_id);"></span></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-1 "> </div>

<div class='modal fade' id='modal_data' role='dialog'>
	<div class='modal-dialog'>
	<div  class='modal-content modal-inverse'>
		<div class='modal-header'>
			<button type='button' class='close icon' data-dismiss='modal'>&times;</button>
			<h4><span class='glyphicon '></span>ข้อมูลผู้ใช้</h4>
		</div>
		<div class='modal-body' align='center'  >
			<table class="table-modal  table table-inverse">
					<tr>
					<td> คำนำหน้า:</td>
					<td>
						<input type="text" name="tb_st_name" id="tb_st_name"  ng-model="emp_st_name"/>
						<input type="text" name="tb_e_id" id="tb_e_id" style="display: none;"  ng-model="emp_id"  />
					</td>
				</tr>
				<tr>
					<td>ชื่อ :</td>
					<td>
				 	<input type="text" name="tb_fname" id="tb_fname"  ng-model="emp_fname"/> 
					</td>
				</tr>
					<tr>
					<td> นามสกุล:</td>
					<td>
						<input type="text" name="tb_lname" id="tb_lname"  ng-model="emp_lname"/>
					</td>
				</tr>
				<tr>
					<td> ชื่อเล่น:</td>
					<td>
						<input type="text" name="tb_e_nickname" id="tb_e_nickname"  ng-model="emp_nickname"/>
					</td>
				</tr>
        <tr>
          <td> เงินเดือน:</td>
          <td>
            <input type="number" name="tb_salary" id="tb_salary"  class="inputtxt"   ng-model="emp_current_salary"/>
          </td>
        </tr>
				<tr>
					<td> ชื่อผู้ใช้:</td>
					<td>
						<input type="text" name="tb_e_username" id="tb_e_username"  ng-model="emp_username"/>
					</td>
				</tr>
				<tr>
					<td> รหัสผ่าน</td>
					<td>
						<input type="text" name="tb_e_password" id="tb_e_password"   ng-model="emp_password"/>
					</td>
				</tr>
				<tr>
					<td>ตำแหน่งงาน:</td>
					<td>
						<select  class="selectopt"   id='dd_Level' >

						</select>
					</td>
				</tr>
				<tr>
          <tr>
            <td> รูปภาพ1</td>
            <td>
              <div class="input-box">
              <input type="file" id="file" class="input-text" ngf-change="onChange($files)" ngf-select ng-model="picFile" name="attachement" accept="image/*" capture="camera"/>
              </div>
              <img ng-show="isImage(fileExt)" ngf-src="picFile[0]" class="thumb">
            </td>
          </tr>
					<td>บันทึก:</td>
					 <td><span  class="glyphicon glyphicon-floppy-save data-save icon" ng-click="saveemp()"></span></td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>
</div>
