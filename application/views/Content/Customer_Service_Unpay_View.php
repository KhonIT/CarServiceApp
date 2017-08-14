<div ng-controller="cusServicesController" >
  <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

<div class="panel panel-inverse">
  <div class="panel-heading" align="center"><h3 class="sub-header">การใช้บริการ</h3> </div>
  <div class="panel-body">



      <div class="table-responsive" align="center">
            <table  class="table table-inverse"  >
                <thead>
                    <tr >
                      <th>ลำดับที่</th>
                      <th>ชื่อ</th>
                      <th>เบอร์โทร</th>
                      <th>ทะเบียน-ยี่ห้อ-รุ่น-สี</th>
                      <th>วันที่ใช้บริการ</th>
                      <th>แก้ไข</th>
                      <th>ชำระเงิน</th>
                      <th>ลบ</th>
                    </tr>
                </thead>
                <tbody id='tbody_list'>
                  <tr ng-repeat="cs in customer_service">
                  <td align="center">{{$index + 1}}</td>
                  <td>{{cs.cus_name}}</td>
                  <td>{{cs.cus_tel}}</td>
                  <td>{{cs.car_regis_number}}-{{cs.car_brand}}-{{cs.car_model}}-{{cs.car_color}}</td>
                  <td>{{cs.receipt_date }}</td>
                  <td align="center"><span class="glyphicon glyphicon-option-horizontal edit-data icon"  ng-click="EditCusService(cs.id)"></span></td>
                  <td align="center"><span class="glyphicon glyphicon-usd icon " target="_blank" ng-click="payment(cs.id)"  ></span></td>
                  <td align="center"><span class="glyphicon glyphicon-remove remove-data icon "  ng-click="removeCusService(cs.id)" ></span></td></tr>
                </tbody>
            </table>
        </div>
          </div>
</div>

    </div>
    <div class="col-sm-2 "> </div> 
  
  
<div class='modal fade' id='modal_data_payment' role='dialog'>
	<div class='modal-dialog'>
	<div  class='modal-content modal-inverse'>
		<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal'>&times;</button>
			<h4><span class='glyphicon '></span>ข้อมูลผู้ใช้</h4>
		</div>
		<div class='modal-body' align='center'  >
    <table class="table-modal table table-inverse ">
            <tr class="cus_detail ">
                <td class="text-left h3">การชำระเงิน :  <input type="radio" name="payment" value="cash" id="cash" ng-model="payment_status" style="width:1em;height:1em;cursor:pointer;"> <label for="cash" style="cursor:pointer;">เงินสด</label>
                  <input type="radio" name="payment" value="credit" id="credit" ng-model="payment_status" style="width:1em;height:1em;cursor:pointer;"> <label for="credit" style="cursor:pointer;" >บัตรเครดิต </label> 
                 </td>
            
              </tr>  
              <tr>
                <td align="center"  ><span class="glyphicon glyphicon-print  icon " target="_blank" ng-click="confirm_print()"  ></span></td>
              </tr>
              </table>
		</div>
		</div>
	</div>
</div> 



<div class='modal fade' id='modal_data' role='dialog'>
	<div class='modal-dialog'>
	<div  class='modal-content modal-inverse'>
		<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal'>&times;</button>
			<h4><span class='glyphicon '></span>ข้อมูลผู้ใช้</h4>
		</div>
		<div class='modal-body' align='center'  >
			<table class="table-modal table table-inverse ">
        <tr>
          <td> ข้อมูล ลูกค้า </td>
          <td>
              <span class='data-cus' >ชื่อ-เบอร์โทร-ทะเบียน-ยี่ห้อ-รุ่น-สี</span>
              <span class='data-edit-cus icon ' id=''>แก้ไข</span>
              <span class='data-add-cus icon glyphicon glyphicon-plus' id=''>เพิ่ม</span>
              <span class='data-search-cus icon glyphicon glyphicon-search' id=''>ค้นหา</span>
          </td>
        </tr>
        <tr>
          <td> ใบเสร็จเล่มที่</td>
          <td> <input type="number" name="tb_book_no" id="tb_book_no"   />
                <input type="text" name="tb_id" id="tb_id" style="display: none;"   />
                <input type="text" name="tb_cus_id" id="tb_cus_id" style="display: none;"   />
          </td>
        </tr>

        <tr>
          <td> ใบเสร็จเลขที่</td>
          <td> <input type="number" name="tb_number" id="tb_number"   /></td>
        </tr>

        <tr>
          <td>รายละเอียดการบริการ</td>
          <td>
            <table class="table-modal" id='table_order_detail'>
            </table>
          </td>
        </tr>
        <tr>
          <td> ราคารวม</td>
          <td> <input type="number" name="tb_total" id="tb_total"   /></td>
        </tr>
        <tr>
          <td>หมายเหตุ :</td>
          <td>
            <input type="text" name="tb_comment" id="tb_comment"   />
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
 
<div class='modal fade' id='modal_data' role='dialog'>
  <div class='modal-dialog'>
  <div  class='modal-content modal-inverse'>
      <div class='modal-header'   >
    <button type='button' class='close icon' data-dismiss='modal'>&times;</button>
        <h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
      </div>
  <div class='modal-body text-center table-responsive' >
    
  <div class="col-sm-1 "> </div>
  <div class="col-sm-10 "> 
    <div class="panel panel-inverse">
    <div class="panel-heading text-center" ><h3 class="sub-header">รับรถ</h3> </div>
      <div class="panel-body  table-responsive">
            <div class="alert hidden text-center msgbox">{{msg}}</div>
                <table  class="table table-inverse"  >
              <tr> 
                <td class="text-right" style="width:30%; vertical-align:middle;">ค้นหา : </td> 
                <td class="text-left" style="width:70%;  vertical-align:middle;">  <input type="text"    ng-keypress="checkIfEnterKey($event)" ng-model="car_regis_number"  placeholder="ทะเบียนรถ"   /> <button type="button" class="btn btn-inverse data-search-cus   glyphicon glyphicon-search"  ng-click="car_search();">ค้นหา</button>  </td> 
              </tr>
              <tr  class="cus_detail hidden">
                <td class="text-right">ชื่อ : </td>
                <td>
                  <span class="cus_lb hidden">{{cus_name}}</span>
                  <input type="text" class="cus_txt"  ng-model="cus_name" /> 
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">เบอร์โทร : </td>
                <td>
                  <span class="cus_lb hidden">{{cus_tel}}</span>
                  <input type="text" class="cus_txt"  ng-model="cus_tel" />
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">ทะเบียน : </td>
                <td>
                  <span class="cus_lb hidden">{{car_regis_number}}</span>
                  <input type="text" class="cus_txt"  ng-model="car_regis_number" />
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">จังหวัด : </td>
                <td>
                  <span class="cus_lb hidden">{{car_regis_province}}</span> 
                  <input type="text" class="cus_txt"  ng-model="car_regis_province" list="province_list"/> 
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">ยี่ห้อ : </td>
                <td>
                  <span class="cus_lb hidden">{{car_brand}}</span>
                  <input type="text" class="cus_txt"  ng-model="car_brand"  list="logo_list" />
                
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">รุ่น : </td>
                <td>
                  <span class="cus_lb hidden">{{car_model}}</span> 
                  <input type="text" class="cus_txt"  ng-model="car_model" />
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">สี : </td>
                <td> 
                  <span class="cus_lb hidden">{{car_color}}</span>
                  <input type="text" class="cus_txt"  ng-model="car_color" />
                </td>
              </tr>
              <tr class="cus_detail hidden">
                <td class="text-right">ขนาด : </td>
                <td>    
                  <span class="cus_lb hidden">{{car_size}}</span>              
                  <select class="selectopt cus_txt hidden"  ng-model="car_size">
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="XXL">XXL</option>
                  </select> 
                  </td>
              </tr>  
            <tr class="cus_detail cus_edit hidden">
                <td colspan="2" class="text-center"  >
                  <span  class=' icon glyphicon glyphicon-list-alt'  ng-click="EditCus();">แก้ไขข้อมูลลูกค้า</span>
                </td> 
              </tr> 
            <tr>
              <td colspan="2" class="text-center service_detail hidden"  id="choose_service">
                <span  class=' icon glyphicon glyphicon-wrench'  ng-click="servicelist();">เลือกการบริการ</span>
                </td>
              </tr> 
              <tr> 
              <td colspan="2" class="text-center service_detail hidden"   >
                <div class="col-sm-1 "> </div>
                <div class="col-sm-10 ">
                  <div  ng-repeat="service in services " class="text-left">
                    <span class="text-left">{{$index + 1}} : {{service.name}} ราคา {{service.price}}</span>
                  </div>
                </div>
                <div class="col-sm-1 "> </div>
                </td>
              </tr> 

              <tr  class="service_detail hidden">
                <td class="text-right"> ราคารวม</td>
                <td> {{total_price | currency:""}} บาท</td>
              </tr> 
              <tr class="service_detail hidden">
                <td class="text-right">หมายเหตุ :</td>
                <td>
                  <input type="text" name="tb_comment" id="tb_comment" ng-model="comment"   />
                </td>
              </tr>
              <tr class="service_detail hidden">
                <td class="text-right ">บันทึก:</td>
                <td><span  class="glyphicon glyphicon-floppy-save data-save icon" ng-click="saveservice();"> </span></td>
              </tr>
            </table>
              <div class="alert hidden text-center  msgbox"   >{{msg}}</div>
          </div>
      </div>
</div>
<div class="col-sm-1 "> </div>

            
      </div>
    </div>
  </div>
</div>

  <div class='modal fade' id='modal_data_service_detail' role='dialog'>
  <div class='modal-dialog'>
  <div  class='modal-content modal-inverse'>
      <div class='modal-header'   >
    <button type='button' class='close icon' data-dismiss='modal'>&times;</button>
        <h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
      </div>
  <div class='modal-body text-center table-responsive' >
    <table class="table-modal  table table-inverse ">
          <tbody id='tbody_list'>
            <tr   ng-repeat="serall in service_all ">
              <!-- <td class="text-center">{{$index + 1}}</td>-->

              <td class="text-left">
              <label class="icon"><input type="checkbox" id="service_detail" value="{{''+serall.service_id}}"  /> {{serall.service_name}}</label></td>

              <td class="text-left"><input type="text" class="inputtxt"  id="{{'price-'+serall.service_id}}"  value="{{serall.price}}"   />
                  <input type="text"  id="{{'name-'+serall.service_id}}" style="display: none;" value="{{serall.service_name}}"   /></td>
            </tr>
            <tr>
              <td colspan='3' class="text-center">
                <span  class="glyphicon glyphicon-floppy-save save-data icon" style="font-size:50px;" ng-click="cal_service();"></span>
              </td>
            </tr>
          </tbody>
        </table>
              <div class="alert hidden text-center msgbox"   >{{msg}}</div>
      </div>
    </div>
  </div>
</div>


