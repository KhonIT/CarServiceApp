    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

		<div class="panel panel-default">
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อสิทธิ์การใช้งาน</h3> </div>
		  <div class="panel-body">
		     <div align="right" class="green"  id="icon_add_level"  >
				<span class="level-add u icon">เพิ่ม</span>
				<span class="glyphicon glyphicon-plus  level-add icon"></span>
		  </div>

		  <!-- Table -->
		      <div class="table-responsive" align="center">
		            <table  class="table_level table-striped"  >
		                <thead>
		                    <tr >
		                        <th>ลำดับที่</th>
		                        <th>ชื่อ</th>
		                        <th>ภายใต้</th>
		                        <th>แก้ไข</th>
		                        <th>แก้ไขสิทธ์</th>
		                        <th>ลบ</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_level' ng-repeat="lev in level |orderBy:sortKey:reverse|filter:search">
                      <tr>
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">{{lev.l_name}}</td>
                        <td class="text-left">{{lev.l_parent_name}}</td>
                        <td class=" text-center"><span class="glyphicon glyphicon-option-horizontal level-edit icon " ng-click="inslevel(cus.l_id);"></span></td>
                        <td class=" text-center"><span class="glyphicon glyphicon-option-horizontal permission-edit icon " ng-click="editlevel(cus.l_id);"></span></td>
                        <td class=" text-center"><span class="glyphicon glyphicon-remove level-remove icon " ng-click="deletelevel({{''+cus.l_id}});"></span></td>
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
				<h4><span class='glyphicon '></span>เพิ่มข้อมูล</h4>
			</div>
			<div class='modal-body' >
				<table class="table-modal">
					<tr>
						<td>ชื่อลำดับ :</td>
						<td><input type="text" name="tb_l_name_add" id="tb_l_name_add"   /></td>
						<td colspan='2'><span  class="glyphicon glyphicon-floppy-save level-add icon"></span> </td>
					</tr>
					<tr>
						<td>ภายใต้ :</td>
						<td><select   id='dd_Level_add' > </select></td>
					</tr>
				</table>
			</div>
			</div>
		</div>
	</div>
	<div class='modal fade' id='modal_level_edit' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>เพิ่มข้อมูล</h4>
			</div>
			<div class='modal-body' >
				<table class="table-modal">
					<tr>
						<td>ชื่อลำดับ :</td>
						<td>
							<input type="text" name="tb_l_name_edit" id="tb_l_name_edit"   />
							<input type="text" name="tb_l_id_edit" id="tb_l_id_edit" style="display:none;"   />
						</td>
						<td colspan='2'><span  class="glyphicon glyphicon-floppy-save level-edit-save icon"></span> </td>
					</tr>
					<tr>
						<td>ภายใต้ :</td>
						<td> <select   id='dd_Level_edit' > </select> 						</td>
					</tr>
				</table>
			</div>
			</div>
		</div>
	</div>


	<div class='modal fade' id='modal_permission_edit' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>แก้ไขสิทธ์</h4>
			</div>
			<div class='modal-body' align="center" >
				<table class="table-modal">
					 <thead>
		                    <tr >
		                        <th>ลำดับที่</th>
		                        <th>ชื่อสิทธ์</th>
		                        <th>ชื่อเมนู</th>
		                        <th>อนุญาติแก้ไข</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_permission'>

		                </tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
