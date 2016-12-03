    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">

<div class="panel panel-default">
  <div class="panel-heading" align="center"><h3 class="sub-header">รายงานการบริการ</h3> </div>
  <div class="panel-body">
    <ul class="nav nav-tabs green">
                <li class="active"><a data-toggle="tab" href="#daily">รายงานรายวัน</a></li>
                <li><a data-toggle="tab" href="#monthly">รายงานรายเดือน</a></li>
                <li><a data-toggle="tab" href="#annualy">รายงานรายปี</a></li>
            </ul>

  <div class=" col-md-12 tab-content">
      <div id="daily"  class="tab-pane fade in active"  align="center">
        <table class="table-modal " >
          <tr>
              <td colspan="2" class="text-center">เลือกข้อมูลที่ต้องการออกรายงาน  </td>
          </tr>
          <tr>
            <td> ปี:</td>
            <td> <select   id='dd_year_daily' > </select> 	</td>
          </tr>
          <tr>
            <td> เดือน:</td>
            <td> <select   id='dd_month_daily' > </select> 	</td>
          </tr>
          <tr>
              <td> การบริการ : </td>
              <td><select   id='dd_service_daily' > </select></td>
          </tr>

          <tr>
            <td colspan='2' class="text-center">
              <span  class="glyphicon glyphicon-paste daily-preview-data icon" ></span>
            </td>
          </tr>
        </table>
        <div  id="linechart_dairy" style="width: 900px; height: 500px">  </div>
        <div class="table-responsive" align="center">

              <table  class="table_head table-striped"  >
                  <thead  >
                        <tr>
                          <th>ลำดับที่</th>
                          <th>วันที่</th>
                          <th>จำนวนเงิน</th>
                        </tr>
                  </thead>
                  <tbody id='tbody_list_daily'>

                  </tbody>
              </table>
          </div>
      </div>
      <div id="monthly" class="tab-pane fade" align="center">
        <table class="table-modal " >
          <tr>
              <td colspan="2" class="text-center">เลือกข้อมูลที่ต้องการออกรายงาน  </td>
          </tr>
          <tr>
              <td> การบริการ </td>
              <td><select   id='dd_service_monthly' > </select></td>
          </tr>
          <tr>
            <td colspan='2' class="text-center">
              <span  class="glyphicon glyphicon-paste monthly-preview-data icon" ></span>
            </td>
          </tr>
        </table>
        <div  id="linechart_monthly"  style="width: 900px; height: 500px">  </div>
        <div class="table-responsive" >

              <table  class="table_head table-striped"  >
                  <thead  >
                        <tr>
                          <th>ลำดับที่</th>
                          <th>เดือน-ปี</th>
                          <th>จำนวนเงิน</th>
                        </tr>
                  </thead>
                  <tbody id='tbody_list_monthly'>

                  </tbody>
              </table>
          </div>
      </div>
      <div id="annualy" class="tab-pane fade" align="center" >
        <table class="table-modal " >
          <tr>
              <td colspan="2" class="text-center">เลือกข้อมูลที่ต้องการออกรายงาน  </td>
          </tr>
          <tr>
              <td> การบริการ </td>
              <td><select   id='dd_service_annualy' > </select></td>
          </tr>
          <tr>
            <td colspan='2' class="text-center">
              <span  class="glyphicon glyphicon-paste annualy-preview-data icon" ></span>
            </td>
          </tr>
        </table>
        <div  id="linechart_annualy" style="width: 900px; height: 500px; ">  </div>
        <div class="table-responsive" >

              <table  class="table_head table-striped"  >
                  <thead  >
                        <tr>
                          <th>ลำดับที่</th>
                          <th>ปี</th>
                          <th>จำนวนเงิน</th>
                        </tr>
                  </thead>
                  <tbody id='tbody_list_annualy'>

                  </tbody>
              </table>
          </div>
      </div>

      </div>
        </div>

</div>

    </div>
    <div class="col-sm-1 "> </div>
