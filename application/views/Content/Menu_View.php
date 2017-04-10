<div ng-controller="menuController" id="top-panel">
<div class="col-sm-1 "> </div>
<div class="col-sm-10 ">
<div class="panel  panel-inverse ">
  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อเมนู</h3> </div>
  <div class="panel-body">
       <div  class="text-right "   >
          <label for="searchtxt" class="sr-only">ค้นหา</label>
          <input type ='text' class="inputtxt" id="searchtxt" placeholder="ค้นหา" ng-model="search" />
          <span class="glyphicon glyphicon-plus  data-add icon" ng-click="ins();">เพิ่ม</span>
        </div>
  </div>
  <!-- Table -->
      <div class=" panel-body table-responsive" align="center">
        <div   class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
        <!-- Table --> 
           		<table  class="table table-inverse"  >
                <thead>
                    <tr >
                        <th class=" text-center">#</th>
                        <th>ชื่อเมนู</th>
                        <th class=" text-center">แก้ไข</th>
                        <th class=" text-center">ลบ</th>
                    </tr>
                </thead>
                <tbody id='tbody_list'>
					<tr  ng-repeat="obj in menus" >
							<td class="text-center">{{$index + 1}}</td>
							<td class="text-left">
								{{obj.menu_name}} 
							</td> 
							<td align="center"><span class="glyphicon glyphicon-wrench icon " ng-click="edit(obj.menu_id);"></span></td>
							<td align="center"><span class=" glyphicon glyphicon-remove remove-data icon " ng-click="del(obj.menu_id);"></span></td></tr>
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
				<h4><span class='glyphicon '></span>ข้อมูลเมนู</h4>
			</div>
			<div class='modal-body' >
				<table class="table-modal">
					<tr>
						<td>ชื่อเมนู :</td>
						<td>
							<input type="text" class="inputtxt" ng-model="menu_name"   />
							<input type="text" class="inputtxt hidden" ng-model="menu_id"   />
						</td>
				 	</tr>
					<tr>
						<td>Link :</td>
						<td><input type="text" class="inputtxt" ng-model="menu_link_url"  /> </td>
					</tr>
					<tr>
						<td>เมนูหลัก :</td>
						<td> <select class="selectopt"    id='dd_parent_menu' > </select> 						</td>
					</tr>
                    <tr>
                        <td colspan='2' class="text-center">
                            <span  class="glyphicon glyphicon-floppy-save save-data icon"  ng-click="save()"></span> 
                        </td>
                    </tr>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>
