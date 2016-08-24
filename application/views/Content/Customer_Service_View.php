    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 "> 

<div class="panel panel-default"> 
  <div class="panel-heading" align="center"><h3 class="sub-header">ประวัติการใช้บริการ</h3> </div>
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
						<th>ชื่อ</th>
                        <th>เบอร์โทร</th>  
						<th>ทะเบียน-ยี่ห้อ-รุ่น-สี</th>  
						<th>วันที่ใช้บริการ</th>  
                        <th>รายละเอียดการบริการ</th> 
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

<div class='modal fade' id='modal_popup_detail_order' role='dialog'>
	<div class='modal-dialog'>
		<div  class='modal-content'>
			<div class='modal-header'  align="center">
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลรายละเอียดการบริการ</h4>
			</div>
			<div class='modal-body'  align="center"   > 
				<table class="table-modal " > 
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
