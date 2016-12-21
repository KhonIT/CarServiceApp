<div   >
    <div ng-controller="salaryController" >
    <div class="col-sm-1 "> </div>
    <div class="col-sm-10 ">
		<div class="panel panel-default">
		  <div class="panel-heading" align="center"><h3 class="sub-header">รายชื่อพนักงาน</h3> </div>
		  <div class="panel-body">

        <form class="form-inline text-right">
          <div class="form-group">
            <label >Search</label>
            <input type ='text' class="form-control" placeholder="ค้นหา" ng-model="search" />
          </div>
        </form>

		     <div  class="green text-right "  id="icon_add_employee"  >
				<span class="employee-add u icon" ng-click="calsalary();">คำนวณเงินเดือน</span>
				<span class="glyphicon glyphicon-calendar icon" ng-click="calsalary();"></span>
		  </div>

		  <!-- Table -->
		      <div class="table-responsive" align="center">
                  <div align="left"  class="alert  hidden text-center"  id="msgbox" > <p>{{msg}}</p>  </div>
		            <table  class="table-striped"  >
		                <thead>
		                    <tr >
		                        <th>ลำดับที่</th>
		                        <th>ชื่อ</th>
                            <th>ตำแหน่ง</th>
                            <th>เดือน</th>
		                        <th>ลบ</th>
		                    </tr>
		                </thead>
		                <tbody id='tbody_data'>
                      <tr class="tbody_list" ng-repeat="emp in employees |orderBy:sortKey:reverse|filter:search">
                        <td class="text-center">{{$index + 1}}</td>
                        <td class="text-left">{{emp.emp_name}}</td>
                        <td class="text-left">{{emp.l_name}}</td>
                          <td class="text-left">{{emp.salary_month}}</td>
                          <td class=" text-center"><span class="glyphicon glyphicon-remove remove-data icon " ng-click="delsalary(emp.slip_id);"></span></td>
                      </tr>
		                </tbody>
		            </table>
		        </div>
			</div>
		</div>
	</div>
    <div class="col-sm-1 "> </div> 
</div>
</div>
