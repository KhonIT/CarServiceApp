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
                      <th>ชำระเงิน</th>
                      <th>ยกเลิก</th>
                    </tr>
                </thead>
                <tbody id='tbody_list'>
                  <tr ng-repeat="cs in customer_service">
                  <td align="center">{{$index + 1}}</td>
                  <td>{{cs.cus_name}}</td>
                  <td>{{cs.cus_tel}}</td>
                  <td>{{cs.car_regis_number}}-{{cs.car_brand}}-{{cs.car_model}}-{{cs.car_color}}</td>
                  <td>{{cs.receipt_date }}</td> 
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
    <table class="table-modal table table-inverse h3">
        
              <tr  >
                <td class="text-right "> ใบเสร็จเลขที่ :     </td> 
                <td>  <input type="text"  ng-model="book_no"   /> 
                 </td> 
              </tr> 
            <tr >
                <td class="text-right ">การชำระเงิน :     </td> 
                <td> <input type="radio" name="payment" value="cash" id="cash" ng-model="payment_status" style="width:1em;height:1em;cursor:pointer;"> <label for="cash" style="cursor:pointer;">เงินสด</label>
                  <br><input type="radio" name="payment" value="credit" id="credit" ng-model="payment_status" style="width:1em;height:1em;cursor:pointer;"> <label for="credit" style="cursor:pointer;" >บัตรเครดิต </label> 
                 </td> 
              </tr>  
              <tr  >
                <td class="text-right "> ราคารวม :      </td> 
                <td> <input type="text"  ng-model="total_price"   /> บาท
                 </td> 
              </tr> 
              <tr  >
                <td class="text-right ">หมายเหตุ :     </td> 
                <td> <input type="text"  ng-model="comment"    />
                 </td> 
              </tr> 
              <tr>
                <td align="center" colspan="2"  ><span class="glyphicon glyphicon-print  icon " target="_blank" ng-click="confirm_print()"  ></span></td>
              </tr>
    </table>
		</div>
		</div>
	</div>
</div> 


 