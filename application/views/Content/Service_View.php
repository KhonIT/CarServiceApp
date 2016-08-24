    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 "> 

<div class="panel panel-default"> 
  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อการบริการ</h3> </div>
  <div class="panel-body">
     <div align="right" class="green "  id="icon_add" >
		<span class="add-data u icon">เพิ่ม</span>
		<span class="glyphicon glyphicon-plus  add-data icon"></span>
	 </div>
  </div>

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
                
                </tbody>
            </table> 
        </div> 
</div>  

    </div>
    <div class="col-sm-2 "> </div>

	<div class='modal fade' id='modal_popup' role='dialog'>
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
							<input type="text" name="tb_name" id="tb_name"   />
							<input type="text" name="tb_id" id="tb_id" style="display:none;"   />
						</td> 
						<td rowspan='2'><span  class="glyphicon glyphicon-floppy-save save-data icon"></span> </td> 
					</tr> 
					<tr> 
						<td>ราคา :</td> 
						<td><input type="text" name="tb_price" id="tb_price"   /> </td>  
					</tr>  
				</table>   
			</div>
			</div>
		</div>
	</div>
