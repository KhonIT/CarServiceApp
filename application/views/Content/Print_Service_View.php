<div ng-controller="printController" >
  <div class="col-sm-1 "> </div>
  <div class="col-sm-10 ">
    <div   class='text-center' >
       <img src="<?php echo base_url(); ?>Assets/Images/logo&sloganNobg.png" />
     </div>

    <table  class="table  table-responsive   table-strip table-hover">

      <tr>
        <td   class='text-left'> เลขที่ใบเสร็จ :{{'' + book_no +'/' +number}}</td>
        <td  class='text-right'>วันที่ :{{date | date:'dd-MM-yyyy hh:mm'}}</td>
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
        <td> รายละเอียดการบริการ</td>
        <td>
          <table  >
            <tr  ng-repeat="service in services ">
              <td class="text-center">{{$index + 1}}</td>
              <td class="text-left">{{service.service_name}}</td>
              <td class="text-left">{{service.service_price}}</td>
            </tr>
            <tr>
              <td colspan="2"> ราคารวม</td>
              <td> {{total_price | currency:""}} บาท</td>
            </tr>
          </table>
        </td>
      </tr> 
    </table>
    </div>
  <div class="col-sm-1 "> </div>
</div>
