<div ng-controller="slipController" >
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">
        <div   class='text-center' >
            <img src="<?php echo base_url(); ?>Assets/Images/logo&sloganNobg.png" />
        </div>

        <table  class="table  table-responsive   table-strip table-hover">
            <tr>
                <td colspan='2'  class='text-right'>วันที่ :{{date | date:'dd-MM-yyyy hh:mm'}}</td>
            </tr>
            <tr>
                <td>ชื่อ :</td>
                <td>{{emp_name}}</td>
            </tr>
            <tr>
                <td>เบอร์โทร</td>
                <td>{{tel}}</td>
            </tr>
            <tr>
                <td>ตำแหน่งงาน</td>
                <td>{{l_name}}</td>
            </tr>
            <tr>
                <td> เงินเดือน:</td>
                <td>{{salary | currency:""}} บาท</td>
            </tr>
        </table>
    </div>
    <div class="col-sm-1 "> </div>
</div>
