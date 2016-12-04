
$(document).ready(function(){

google.charts.load('current', { packages: ['corechart', 'line'] });

google.charts.setOnLoadCallback(salary);
$('#salary').delegate('span.salary-preview-data', 'click', function() {
  salary();
});

 $.ajax({
		url: backend_url+'Report_Salary/Get_Month_Salary',
		data: {},
		dataType: "json",
		type: "POST",
		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#dd_month_salary").find('option').remove().end();
				$("#dd_month_salary").append('<option value="0">เลือกเดือน</option>');
				$.each(data, function(idx, obj) {
							$("#dd_month_salary").append('<option value='+obj.month+'>'+obj.month+'</option>');
				});
			}
	});
	function salary() {
	 $.ajax({
     url: backend_url+'Report_Salary/Get_Salary_Month',
     data: { month:$('#dd_month_salary :selected').val()},
		 cache:false,
		 type: "POST",
		 dataType: "json",
		 success: function (result)
			 {
				 $('#linechart_salary').empty();
			       $("#tbody_list_salary").text("");
      var i = 1;
      $.each(result, function(idx, obj) {
        $("#tbody_list_salary").append('<tr><td>'+i+'</td><td>'+obj.emp_name+'</td><td>'+obj.salary+'</td><td class="text-center"> <a href="'+backend_url+'Report_Salary/PrintSalary?slip_id='+obj.slip_id+'" class="glyphicon glyphicon-print  icon " target="_blank"  ></a></td></tr>');
          i++;
        });
        var options = {
         hAxis: {
           title: 'datename (dd-mm-yyy)'
         },
         vAxis: {
           title: 'Amount(Bath)'
         },   width: 900,
height: 500
       };
                 var data = new google.visualization.DataTable();
                 data.addColumn('string', 'name');
   							data.addColumn('number', 'Salary');
                 $.each(result, function(k, v) {
                   data.addRow([ v.emp_name, parseFloat(v.salary)]);
           });
                 var chart = new google.visualization.LineChart(document.getElementById('linechart_salary'));
           chart.draw(data, options);
			 }
	 });
	}



});
