<div   >
    <div ng-controller="employeeController" >
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">
		<div class="panel panel-default">
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อพนักงาน</h3> </div>
		  <div class="panel-body">

        <form class="form-inline text-right">
          <div class="form-group">
            <label >Search</label>
            <input type ='text' class="form-control" placeholder="ค้นหา" ng-model="search" />
          </div>
        </form>

		     <div  class="green text-right "  id="icon_add_employee"  >
				<span class="employee-add u icon" ng-click="insemp();">เพิ่ม</span>
				<span class="glyphicon glyphicon-plus  employee-add icon" ng-click="insemp();"></span>
		  </div>

		  <!-- Table -->
		      <div class="table-responsive" align="center">
                  <div align="left"  class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
		            <table  class="table-striped"  >
		                <thead>
		                    <tr >
		                        <th>ลำดับที่</th>
		                        <th>ชื่อ</th>
                            <th>ชื่อเล่น</th>
		                        <th>ประเภทของผู้ใช้</th>
		                        <th>แก้ไข</th>
		                        <th>ลบ</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_data'>
                      <tr class="tbody_list" ng-repeat="emp in employees |orderBy:sortKey:reverse|filter:search">
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">{{emp.name}}</td>
                        <td class="text-left">{{emp.nickname}}</td>
                        <td class="text-left">{{emp.l_name}}</td>
                        <td class=" text-center"><span class="glyphicon glyphicon-option-horizontal edit-data icon " ng-click="editemp(emp.e_id);"></span></td>
                        <td class=" text-center"><span class="glyphicon glyphicon-remove remove-data icon " ng-click="delemp(emp.e_id);"></span></td>
                      </tr>


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
			<h4><span class='glyphicon '></span>ข้อมูลผู้ใช้</h4>
		</div>
		<div class='modal-body' align='center'  >
			<table class="table-modal">
				<tr>
					<td>ชื่อ :</td>
					<td>
						<input type="text" name="tb_name" id="tb_name"   ng-model="emp_name" />
						<input type="text" name="tb_e_id" id="tb_e_id" style="display: none;"  ng-model="emp_id"  />
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
            <input type="number" name="tb_salary" id="tb_salary"    ng-model="emp_current_salary"/>
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
						<select   id='dd_Level' >

						</select>
					</td>
				</tr>
				<tr>
					<td>บันทึก:</td>
					 <td><span  class="glyphicon glyphicon-floppy-save data-save icon" ng-click="saveemp()"></span></td>
				</tr>
			</table>
		</div>
		</div>
	</div>
</div>
</div>
</div>
