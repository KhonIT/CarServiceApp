    <div ng-controller="serviceController" id="top-panel">
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

      <div class="panel panel-inverse">
        <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อการบริการ</h3> </div>
        <div class="panel-body">
           <div align="right" class="green "  id="icon_add" >
      		<span class="add-data u icon"  ng-click="ins();">เพิ่ม</span>
      		<span class="glyphicon glyphicon-plus  add-data icon"  ng-click="ins();"></span>
      	 </div>
     <div class="panel-body table-responsive text-center">
       <div class="alert hidden text-center"  id="msgbox" >{{msg}}</div>
        <!-- Table -->
        
           		<table  class="table table-inverse"  >
                      <thead>
                          <tr >
                              <th  class=" text-center">#</th>
                              <th>การบริการ</th>
                              <th>ราคา</th>
                              <th>ขนาดของรถ</th> 
                              <th class=" text-center">บันทึก</th>
                              <th class=" text-center">ลบ</th>
                          </tr>
                      </thead>
                      <tbody id='tbody_list'>
                      <tr  ng-repeat="obj in services" >
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">
	                           <input type="text"  id="tb_name_{{''+obj.service_id}}"  ng-model="obj.service_name"  />
                        </td>
                        <td class="text-left">
                             <input type="text" id="tb_price_{{''+obj.service_id}}"  ng-model="obj.price"  />
                        </td>
                        <td class="text-left"> 
                        <select class="selectopt" id="tb_car_size_{{''+obj.service_id}}" ng-model="obj.car_size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option> 
                        </select>  
                        </td> 
                        <td align="center"><span class="glyphicon glyphicon-floppy-save icon " ng-click="save(obj.service_id);"></span></td>
                        <td align="center"><span class=" glyphicon glyphicon-remove remove-data icon " ng-click="del(obj.service_id);"></span></td></tr>
                      </tbody>
                  </table>
        </div>
      </div>

      </div>
    </div>
    <div class="col-sm-1 "> </div>

	<div class='modal fade' id='modal_data' role='dialog'>
		<div class='modal-dialog'>
		<div  class='modal-content  modal-inverse'>
			<div class='modal-header'>
				<button type='button' class='close icon' data-dismiss='modal'>&times;</button>
				<h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
			</div>
			<div class='modal-body text-center' >
			<table class="table-modal  table table-inverse ">
					<tr>
						<td>การบริการ :</td>
						<td>
							<input type="text" name="tb_name" id="tb_name"  ng-model="service_name"  /> 
						</td>
					</tr>
					<tr>
						<td>ราคา :</td>
						<td><input type="text" name="tb_price" id="tb_price"  ng-model="price"  /> </td>
					</tr>
					<tr>
						<td>	ขนาดของรถ :</td>
						<td>                
                            <select class="selectopt" id="tb_car_size" ng-model="car_size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option> 
                        </select>  
                         </td>
					</tr> 
                    <tr>
                        <td colspan='2' class="text-center">
                            <span  class="glyphicon glyphicon-floppy-save save-data icon"  ng-click="save('0')"></span> 
                        </td>
                    </tr>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>
