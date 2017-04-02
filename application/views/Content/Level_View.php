<div ng-controller="levelController" >
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

		<div class="panel panel-inverse ">
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อสิทธิ์การใช้งาน</h3> </div>
		  <div class="panel-body">
		     <div  class=" darkgray text-right "  id="icon_add_level"  > 
				<span class="glyphicon glyphicon-plus  level-add icon" ng-click="inslevel();">เพิ่ม</span>
		  </div>
		  </div>
	 <div class="panel-body   table-responsive" align="center">
     <div   class="alert  hidden text-center "  id="msgbox" >  {{msg}}  </div>
 
		            <table  class="table table-inverse"  >
		                <thead>
		                    <tr >
		                        <th class=" text-center">#</th>
		                        <th>ชื่อ</th>
		                        <th>ภายใต้</th>
		                        <th class=" text-center">แก้ไข</th>
		                        <th class=" text-center">แก้ไขสิทธ์</th>
		                        <th class=" text-center">ลบ</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_level' >
                      <tr ng-repeat="lev in level |orderBy:sortKey:reverse|filter:search">
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">{{lev.l_name}}</td>
                        <td class="text-left">{{lev.l_parent_name}}</td>
                        <td class=" text-center"><span class="glyphicon glyphicon-wrench level-edit icon " ng-click="editlevel(lev.l_id);"></span></td>
                        <td class=" text-center"><span class="glyphicon glyphicon-wrench permission-edit icon " ng-click="editpermission(lev.l_id);"></span></td>
                        <td class=" text-center"><span class="glyphicon glyphicon-remove-sign level-remove icon " ng-click="dellevel(lev.l_id);"></span></td>
                      </tr>
		                </tbody>
		            </table> 
			</div>
		</div>
	</div>
    <div class="col-sm-1 "> </div>

	<div class='modal fade ' id='modal_data' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content modal-inverse'>
			<div class='modal-header'>
				<button type='button' class='close icon ' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>{{headermsg}}</h4>
			</div>
			<div class='modal-body' >
				<table class="table-modal ">
					<tr>
						<td>ชื่อลำดับ :</td>
						<td>
              <input type="text" name="tb_l_name_add" id="tb_l_name_add" ng-model="l_name" class="inputtxt"   />
              <input type="text" name="tb_l_id_edit" id="tb_l_id_edit" style="display:none;"  ng-model="l_id"  />
            </td> 	
					</tr>
					<tr>
						<td>ภายใต้ :</td>
						<td>
              <select  class="selectopt"  id='dd_Level' ng-model="l_parent_id" >
                  <option  ng-repeat="levopt in level "  value="{{levopt.l_id}}">{{levopt.l_name}}</option>
             </select>
            </td>
					</tr>
					<tr>
					<td colspan='2' class="text-center"><span  class="glyphicon glyphicon-floppy-save level-add icon" ng-click="savedata();"></span> </td>
						</tr>	
				</table>
			</div>
			</div>
		</div>
	</div>


	<div class='modal fade ' id='modal_permission' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content modal-inverse'>
			<div class='modal-header'>
				<button type='button' class='close icon ' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>{{headermsg}}</h4>
			</div>
			<div class='modal-body  table-responsive ' align="center" >
				<table class="table-modal table table-inverse">
					 <thead>
		                    <tr >
		                        <th>#</th>
		                        <th>ชื่อสิทธ์</th>
		                        <th>ชื่อเมนู</th>
		                        <th>อนุญาติแก้ไข</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_permission'>
			 
                      <tr ng-repeat="obj in permission" class='pointer'  ng-click="chkbox('menuid_'+obj.menu_id);" >
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">  {{obj.l_name}} </td>
                        <td class="text-left">  {{obj.parent_menu+':'+obj.menu_name}}  </td>
                        <td  ng-if="obj.is_edit == 1" id='{{obj.permission_id}}' align="center" ><input class="chkbox" type="checkbox" id="{{'menuid_'+obj.menu_id}}"   checked= "checked " value="{{obj.menu_id}}" /> </td>
                        <td  ng-if="obj.is_edit != 1" id='{{obj.permission_id}}' align="center" ><input class="chkbox"  type="checkbox" id="{{'menuid_'+obj.menu_id}}"    value="{{obj.menu_id}}" /> </td>
                      </tr>
                      <tr><td align="center" colspan="4"><span class="glyphicon glyphicon-floppy-save icon " ng-click="savepermission();"   ></span></td></tr>
		                </tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
	</div>
