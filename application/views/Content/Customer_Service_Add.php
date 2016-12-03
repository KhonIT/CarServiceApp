<div ng-controller="cusServiceController" >
  <div class="col-sm-1 "> </div>
  <div class="col-sm-10 ">

<div class="panel panel-default" >
<div class="panel-heading text-center" ><h3 class="sub-header">รับรถ</h3> </div>
<div class="panel-body">

<!-- Table -->
      <table  class="table  table-responsive   table-strip table-hover">
        <tr>
          <td colspan="2">
            <span class='data-search-cus icon glyphicon glyphicon-search'  ng-click="cuslist();">ค้นหาข้อมูลลูกค้า</span>
          </td>
        </tr>
        <tr>
          <td>ชื่อ :</td>
          <td>{{cus_name}}</td>
        </tr>
        <tr>
          <td>เบอร์โทร</td>
          <td>{{cus_tel}}</td>
        </tr>
        <tr>
          <td> ทะเบียนรถ:</td>
          <td>{{cus_car_regis_number}}</td>
        </tr>
        <tr>
          <td>ยี่ห้อ:</td>
          <td>{{cus_car_brand}}</td>
        </tr>
        <tr>
          <td>รุ่น:</td>
          <td>{{cus_car_model}}</td>
        </tr>
        <tr>
          <td>สี</td>
          <td>{{cus_car_color}}</td>
        </tr>
        <tr>
          <td>รายละเอียดการบริการ  <span class=' icon glyphicon glyphicon-list'  ng-click="servicelist();">เพิ่มคลิก</span> </td>
          <td>
            <table  >
              <tr  ng-repeat="service in services ">
                <td class="text-center">{{$index + 1}}</td>
                <td class="text-left">{{service.name}}</td>
                <td class="text-left">{{service.price}}</td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td> ราคารวม</td>
          <td> {{total_price | currency:""}} บาท</td>
        </tr>
        <tr>
          <td>หมายเหตุ :</td>
          <td>
            <input type="text" name="tb_comment" id="tb_comment" ng-model="comment"   />
          </td>
        </tr>
        <tr>
          <td>บันทึก:</td>
           <td><span  class="glyphicon glyphicon-floppy-save data-save icon" ng-click="savecusservice();"> </span></td>
        </tr>
      </table>
                <div  class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
    </div>
</div>
</div>
<div class="col-sm-1 "> </div>


  <div class='modal fade' id='modal_data_add_cus' role='dialog'>
  	<div class='modal-dialog'>
  		<div  class='modal-content'>
  			<div class='modal-header text-center'  >
  				<button type='button' class='close' data-dismiss='modal'>&times;</button>
  				<h4><span class='glyphicon '></span>ข้อมูลรายละเอียดลูกค้า</h4>
  			</div>
  			<div class='modal-body  '   >
          <table class="table-modal " >
            <tr>
                <td>ชื่อ :</td>
                <td>
                    <input type="text" name="tb_cus_name" id="tb_cus_name"  ng-model="cus_name"  />
                    <input type="text" name="tb_id" id="tb_id" style="display: none;" ng-model="cus_id"   />
                </td>
            </tr>
            <tr>
              <td> เบอร์โทร:</td>
              <td><input type="tel" name="tb_cus_tel" id="tb_cus_tel" ng-model="cus_tel" /></td>
            </tr>
            <tr>
              <td> ทะเบียนรถ:</td>
              <td><input type="text" name="tb_cus_car_number" id="tb_cus_car_regis_number" ng-model="cus_car_regis_number"   /></td>
            </tr>
            <tr>
                <td> ยี่ห้อ:</td>
                <td  style="width:500px;"  class="text-left">

                     <img ng-repeat="logo in logos" ng-src="<?php echo base_url(); ?>Assets/Images/iconlogo/{{logo.img}}" style="margin:5px;" class="icon" alt="{{logo.name}}" ng-click="iconlogo_click(logo.name)" />

                 <p>  อื่นๆ : <input type="text" name="tb_cus_car_brand" id="tb_cus_car_brand"  ng-model="cus_car_brand"  /></p></td>
            </tr>
            <tr>
                <td> รุ่น:</td>
                <td><input type="text" name="tb_cus_car_model" id="tb_cus_car_model"  ng-model="cus_car_model" /></td>
            </tr>
            <tr>
                <td> สี</td>
                <td><input type="text" name="tb_cus_car_color" id="tb_cus_car_color"  ng-model="cus_car_color" /></td>
            </tr>
            <tr>
              <td colspan='2' class="text-center">
                <span  class="glyphicon glyphicon-floppy-save save-data icon" ng-click="savecus();"></span>
              </td>
            </tr>
          </table>
  			</div>
  		</div>
  	</div>
  </div>




  <div class='modal fade' id='modal_data_cus_search' role='dialog'>
  	<div class='modal-dialog'>
  		<div  class='modal-content'>
  			<div class='modal-header'  align="center">
  				<button type='button' class='close' data-dismiss='modal'>&times;</button>
  				<h4><span class='glyphicon '></span>ข้อมูลลูกค้า</h4>

          <form class="form-inline">
            <div class="form-group">
              <label >ค้นหา</label>
              <input type ='text' class="form-control" placeholder="ค้นหา" ng-model="search" />
                <span class='data-add-cus icon glyphicon glyphicon-plus ' ng-click="addcus()">เพิ่ม</span>
            </div>
          </form>
  			</div>
  			<div class='modal-body'  align="center"   >
          <div align="left"  class="alert  hidden text-center"  id="msgbox" > <p>{{msgcus}}</p>  </div>
          <table class="table-modal " >
  					       <thead>
                     <tr class="text-center">
                       <th>ลำดับที่</th>
                       <th ng-click="sort('cus_name')">ชื่อ</th>
                       <th ng-click="sort('cus_tel')">เบอร์โทร</th>
                       <th ng-click="sort('cus_car_regis_number')">ทะเบียน</th>
                       <th ng-click="sort('cus_car_brand')">ยี่ห้อ</th>
                       <th ng-click="sort('gender')">รุ่น</th>
                       <th ng-click="sort('cus_car_color')">สี</th>
                       <th>เลือก</th>
                     </tr>

                  </thead>
  					<tbody id='tbody_cus_list'>
              <tr class="tbody_list" ng-repeat="cus in customers |orderBy:sortKey:reverse|filter:search">
                <td class="text-center">{{$index + 1}}</td>
                <td class="text-left">{{cus.cus_name}}</td>
                <td class="text-left">{{cus.cus_tel}}</td>
                <td class="text-left">{{cus.cus_car_regis_number}}</td>
                <td class="text-left">{{cus.cus_car_brand}}</td>
                <td class="text-left">{{cus.cus_car_model}}</td>
                <td class="text-left">{{cus.cus_car_color}}</td>
              <td align="center"><span class="glyphicon glyphicon-share-alt choose-data icon " ng-click="choosecus(cus.id);"id='+obj.id+'></span></td>
              </tr>
  					</tbody>
  				</table>

  			</div>
  		</div>
  	</div>
  </div>


  <div class='modal fade' id='modal_data_service_detail' role='dialog'>
    <div class='modal-dialog'>
      <div  class='modal-content'>
        <div class='modal-header'  align="center">
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4><span class='glyphicon '></span>ข้อมูลการบริการ</h4>
        </div>
        <div class='modal-body'  align="center"   >

          <table class="table-modal " >
            <tbody id='tbody_list'>
              <tr   ng-repeat="serall in service_all ">
                <td class="text-center">{{$index + 1}}</td>

                <td class="text-left"> <label class="icon"><input type="checkbox" id="service_detail" value="{{''+serall.service_id}}"  /> {{serall.service_name}}</label></td>

                <td class="text-left"><input type="number"  id="{{'price-'+serall.service_id}}"  value="{{serall.price}}"   />
                            <input type="text" id="{{'name-'+serall.service_id}}" style="display: none;" value="{{serall.service_name}}"   /></td>
              </tr>

              <tr>
                <td colspan='3' class="text-center">
                  <span  class="glyphicon glyphicon-floppy-save save-data icon" style="font-size:50px;" ng-click="saveservice();"></span>
                </td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

</div>
