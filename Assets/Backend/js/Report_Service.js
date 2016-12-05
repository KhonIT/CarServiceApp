
$(document).ready(function(){

google.charts.load('current', { packages: ['corechart', 'line'] });

google.charts.setOnLoadCallback(dairy);
google.charts.setOnLoadCallback(monthly);
google.charts.setOnLoadCallback(annualy);




$('#daily').delegate('span.daily-preview-data', 'click', function() {
  dairy();
});

$('#monthly').delegate('span.monthly-preview-data', 'click', function() {
  monthly();
});
$('#annualy').delegate('span.annualy-preview-data', 'click', function() {
  annualy();
});


 $.ajax({
		url: backend_url+'Report_Service/Get_Year',
		data: {},
		dataType: "json",
		type: "POST",

		dataFilter: function (data) { return data; },
		success: function (data)
			{
				$("#dd_year_daily").find('option').remove().end();
				$("#dd_year_daily").append('<option value="0">เลือกปี</option>');
				$.each(data, function(idx, obj) {
							$("#dd_year_daily").append('<option value='+obj.year+'>'+obj.year+'</option>');
				});
			}
	});

  $.ajax({
     url: backend_url+'Services/Get_All',
     data: {},
     dataType: "json",
     type: "POST",

     dataFilter: function (data) { return data; },
     success: function (data)
       {
         $("#dd_service_daily").find('option').remove().end();
         $("#dd_service_daily").append('<option value="0">เลือกข้อมูลบริการ</option>');
         $("#dd_service_monthly").find('option').remove().end();
         $("#dd_service_monthly").append('<option value="0">เลือกข้อมูลบริการ</option>');
         $("#dd_service_annualy").find('option').remove().end();
         $("#dd_service_annualy").append('<option value="0">เลือกข้อมูลบริการ</option>');
         $.each(data, function(idx, obj) {
              $("#dd_service_daily").append('<option value='+obj.service_id+'>'+obj.service_name+'</option>');
              $("#dd_service_monthly").append('<option value='+obj.service_id+'>'+obj.service_name+'</option>');
              $("#dd_service_annualy").append('<option value='+obj.service_id+'>'+obj.service_name+'</option>');
         });
       }
   });



$( "#dd_year_daily" ).change(function() {
   $.ajax({
  		url: backend_url+'Report_Service/Get_Month',
  				data: { year:$('#dd_year_daily :selected').val()},
  		dataType: "json",
  		type: "POST",

  		dataFilter: function (data) { return data; },
  		success: function (data)
  			{
  				$("#dd_month_daily").find('option').remove().end();
  				$("#dd_month_daily").append('<option value="0">เลือกเดือน</option>');
  				$.each(data, function(idx, obj) {
  							$("#dd_month_daily").append('<option value='+obj.month+'>'+obj.month+'</option>');
  				});
  			}
  	});
});



	function dairy() {
	 $.ajax({
     url: backend_url+'Report_Service/daily',
     data: { year:$('#dd_year_daily :selected').val(),month:$('#dd_month_daily :selected').val(),service_id:$('#dd_service_daily :selected').val()},
		 cache:false,
		 type: "POST",
		 dataType: "json",
		 success: function (result)
			 {
				 $('#linechart_dairy').empty();
			       $("#tbody_list_daily").text("");
      var i = 1;
        var summary = 0;
      $.each(result, function(idx, obj) {
        $("#tbody_list_daily").append('<tr><td>'+i+'</td><td>'+obj.name+'</td><td>'+obj.total+'</td></tr>');
          i++;
              summary += parseFloat(obj.total);
        });
            $("#tbody_list_daily").append('<tr><td colspan="2" class="text-right "><strong>รวม</strong></td><td  class="text-left">'+summary.toFixed(2)+'</td></tr>');
        var options = {
         hAxis: {
           title: 'datename (dd-mm-yyy-hh)'
         },
         vAxis: {
           title: 'Amount(Bath)'
         },   width: 900,
height: 500
       };
                 var data = new google.visualization.DataTable();
                 data.addColumn('string', 'name');
   							data.addColumn('number', 'Amount');
                 $.each(result, function(k, v) {
                   console.log(k+'-'+v.name+'-'+v.total);
                   data.addRow([ v.name, parseFloat(v.total)]);
           });
                 var chart = new google.visualization.LineChart(document.getElementById('linechart_dairy'));
           chart.draw(data, options);
			 }
	 });
	}


	function monthly() {

				 $.ajax({
					 url: backend_url+'Report_Service/monthly',
  	      data: { service_id:$('#dd_service_monthly :selected').val()},
					 cache:false,
					 type: "POST",
					 dataType: "json",
					 success: function (result)
						 {
							 $("#tbody_list_monthly").text("");
							 $("#tbody_list_monthly").text("");
							var i = 1;

                var summary = 0;

							$.each(result, function(idx, obj) {
								$("#tbody_list_monthly").append('<tr><td>'+i+'</td><td>'+obj.month+'-'+obj.year+'</td><td>'+obj.total+'</td></tr>');
									i++;summary += parseFloat(obj.total);
								});
                  $("#tbody_list_monthly").append('<tr><td colspan="2" class="text-right "><strong>รวม</strong></td><td  class="text-left">'+summary.toFixed(2)+'</td></tr>');
			var data = new google.visualization.DataTable();
                  data.addColumn('string', 'name');
                  data.addColumn('number', 'Amount');

                			 $.each(result, function(k, v) {
						 	 data.addRow([ v.month, parseFloat(v.total)]);
								 });
								 var options = {
		 							hAxis: {
		 								title: 'Year'
		 							},
		 							vAxis: {
		 								title: 'Amount(Bath)'
		 							},   width: 900,
        height: 500
		 						};
											 var chart = new google.visualization.LineChart(document.getElementById('linechart_monthly'));
								 chart.draw(data, options);
						}
				 });
	 }

	 function annualy() {
	 	$.ajax({
	 		url: backend_url+'Report_Service/annualy',
  	      data: { service_id:$('#dd_service_annualy :selected').val()},
	 		cache:false,
	 		type: "POST",
	 		dataType: "json",
	 		success: function (result)
	 			{
	 				$("#tbody_list_annualy").text("");
	 				var i = 1;

            var summary = 0;
	 				$.each(result, function(idx, obj) {
	 					$("#tbody_list_annualy").append('<tr><td>'+i+'</td><td>'+obj.name+'</td><td>'+obj.total+'</td></tr>');
	 						i++;				i++;summary += parseFloat(obj.total);
	 					});
              $("#tbody_list_annualy").append('<tr><td colspan="2" class="text-right "><strong>รวม</strong></td><td  class="text-left">'+summary.toFixed(2)+'</td></tr>');


              var data = new google.visualization.DataTable();
              data.addColumn('string', 'name');
              data.addColumn('number', 'Amount');
                	 var options = {
	 									 hAxis: {
	 										 title: 'Year'
	 									 },
	 									 vAxis: {
	 										 title: 'Amount(Bath)'
	 									 },   width: 900,
        height: 500
	 								 };
	 								 $.each(result, function(k, v) {
	 			     data.addRow([v.name, parseFloat(v.total)]);
	 					 });

	 								 var chart = new google.visualization.LineChart(document.getElementById('linechart_annualy'));
	 		   	 	 chart.draw(data, options);
	 			}
	 	});
	 }
});
