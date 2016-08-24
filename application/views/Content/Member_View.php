    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">  
		<div class="panel panel-default"> 
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อผู้ใช้</h3> </div>
		  <div class="panel-body">
		     <div align="right" class="green "  id="icon_add_member"  > 
				<span class="member-add u icon">เพิ่ม</span>
				<span class="glyphicon glyphicon-plus  member-add icon"></span> 
		  </div>
		
		  <!-- Table -->
		      <div class="table-responsive" align="center"> 
		            <table  class="table_member table-striped"  >
		                <thead>
		                    <tr >
		                        <th>ลำดับที่</th>
		                        <th>ชื่อ</th>   
		                        <th>Email</th>   
		                        <th>ประเภทของผู้ใช้</th>   
		                        <th>แก้ไข</th> 
		                        <th>ลบ</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_member'>
		                
		                </tbody>
		            </table> 
		        </div> 
			</div>
		</div>
	</div>
    <div class="col-sm-1 "> </div>
 
<div class='modal fade' id='modal_member' role='dialog'>
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
						<input type="text" name="tb_m_name" id="tb_m_name"   /> 
						<input type="text" name="tb_m_id" id="tb_m_id" style="display: none;"   /> 
					</td>
			
				</tr>   
				<tr> 
					<td>E-mail:</td> 
					<td>
						<input type="email" placeholder="Enter your email" name="tb_m_email" id="tb_m_email"    />
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
					 <td><span  class="glyphicon glyphicon-floppy-save member-save icon"></span></td>	
				</tr> 
			</table>   
		</div>
		</div>
	</div>
</div>
 