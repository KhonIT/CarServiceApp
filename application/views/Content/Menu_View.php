    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 "> 

<div class="panel panel-default"> 
  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อเมนู</h3> </div>
  <div class="panel-body">
     <div align="right" class="green "  id="icon_add_menu" >
		<span class=" menu-add u icon">เพิ่ม</span>
		<span class="glyphicon glyphicon-plus  menu-add icon"></span>
	 </div>
  </div>

  <!-- Table -->
      <div class="table-responsive" align="center"> 
            <table  class="table_menu table-striped"  >
                <thead>
                    <tr >
                        <th>ลำดับที่</th>
                        <th>ชื่อเมนู</th>  
                        <th>แก้ไข</th> 
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody id='tbody_menu'>
                
                </tbody>
            </table> 
        </div> 
</div>  

    </div>
    <div class="col-sm-2 "> </div>

	<div class='modal fade' id='modal_menu' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลเมนู</h4>
			</div>
			<div class='modal-body' > 
				<table class="table-modal"> 
					<tr> 
						<td>ชื่อเมนู :</td> 
						<td>
							<input type="text" name="tb_menu_name" id="tb_menu_name"   />
							<input type="text" name="tb_menu_id" id="tb_menu_id" style="display:none;"   />
						</td> 
						<td rowspan='2'><span  class="glyphicon glyphicon-floppy-save menu-save icon"></span> </td> 
					</tr> 
					<tr> 
						<td>Link :</td> 
						<td><input type="text" name="tb_link_url" id="tb_link_url"   /> </td>  
					</tr> 
					<tr> 
						<td>เมนูหลัก :</td> 
						<td> <select   id='dd_parent_menu' > </select> 						</td>  
					</tr> 
				</table>   
			</div>
			</div>
		</div>
	</div>
