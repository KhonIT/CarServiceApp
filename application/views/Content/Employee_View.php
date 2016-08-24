    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">  
		<div class="panel panel-default"> 
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อพนักงาน</h3> </div>
		  <div class="panel-body">
		     <div align="right" class="green "  id="icon_add_employee"  > 
				<span class="employee-add u icon">เพิ่ม</span>
				<span class="glyphicon glyphicon-plus  employee-add icon"></span> 
		  </div>
		
		  <!-- Table -->
		      <div class="table-responsive" align="center"> 
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
						<input type="text" name="tb_name" id="tb_name"   /> 
						<input type="text" name="tb_e_id" id="tb_e_id" style="display: none;"   /> 
					</td> 
				</tr>   
				<tr> 
					<td> ชื่อเล่น:</td> 
					<td>
						<input type="text" name="tb_e_nickname" id="tb_e_nickname"   /> 
					</td> 
				</tr>
				<tr> 
					<td> ชื่อผู้ใช้:</td> 
					<td>
						<input type="text" name="tb_e_username" id="tb_e_username"   /> 
					</td> 
				</tr> 
				<tr> 
					<td> รหัสผ่าน</td> 
					<td>
						<input type="text" name="tb_e_password" id="tb_e_password"   /> 
					</td> 
				</tr>
				<tr> 
					<td>ประเภทของผู้ใช้:</td> 
					<td>
						<select   id='dd_Level' >
                                                   
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
</div>
 