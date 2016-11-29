
$(document).ready(function(){

google.charts.load('current', { packages: ['corechart', 'line'] });

 //google.charts.setOnLoadCallback(dairy);
google.charts.setOnLoadCallback(monthly);
google.charts.setOnLoadCallback(annualy);
 
$.ajax({
	url: backend_url+'Report_Service/daily',
	data: {},
	cache:false,
	type: "POST",
	dataType: "json",
	success: function (result)
		{
			 $("#tbody_list_daily").text("");
			var i = 1;
			$.each(result, function(idx, obj) {
				$("#tbody_list_daily").append('<tr><td>'+i+'</td><td>'+obj.year +'-'+ obj.month +'-'+ obj.day_no+'</td><td>'+obj.total+'</td></tr>');
					i++;
				});
		}
});

	function dairy() {
	 $.ajax({
		 url: backend_url+'Report_Service/daily',
		 data: { },
		 cache:false,
		 type: "POST",
		 dataType: "json",
		 success: function (result)
			 {
				 $('#linechart_dairy').empty();
				  $("#tbody_list_dairy").text("");
				 var i = 1;

				 $.each(result, function(idx, obj) {
					 $("#tbody_list_dairy").append('<tr><td>'+i+'</td><td>'+obj.year +'-'+ obj.month +'-'+ obj.day_no+'</td><td>'+obj.total+'</td></tr>');
						 i++;
					 });
									var options = {
										hAxis: {
											title: 'Date'
										},
										vAxis: {
											title: 'Amount(Bath)'
										} ,  width: 900, height: 500
									};
									var data = new google.visualization.DataTable();
									data.addColumn('string', 'Date_name');
									data.addColumn('number', 'Amount');
									$.each(result, function(k, v) {
												data.addRow([	  v.year ,0]);
									});
									var chart = new google.visualization.LineChart(document.getElementById('linechart_dairy'));
						chart.draw(data, options);
			 }
	 });
	}


	function monthly() {

				 $.ajax({
					 url: backend_url+'Report_Service/monthly',
					 data: { },
					 cache:false,
					 type: "POST",
					 dataType: "json",
					 success: function (result)
						 {
							 $("#tbody_list_monthly").text("");
							 $("#tbody_list_monthly").text("");
							var i = 1;
							var data = new google.visualization.DataTable();
							data.addColumn('string', 'name');
							data.addColumn('number', 'Amount');
							$.each(result, function(idx, obj) {
								$("#tbody_list_monthly").append('<tr><td>'+i+'</td><td>'+obj.month+'-'+obj.year+'</td><td>'+obj.total+'</td></tr>');
									i++;
								});
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
	 		data: {},
	 		cache:false,
	 		type: "POST",
	 		dataType: "json",
	 		success: function (result)
	 			{
	 				$("#tbody_list_annualy").text("");
	 				var i = 1;
	 				var data = new google.visualization.DataTable();
	 				data.addColumn('string', 'name');
	 				data.addColumn('number', 'Amount');
	 				$.each(result, function(idx, obj) {
	 					$("#tbody_list_annualy").append('<tr><td>'+i+'</td><td>'+obj.name+'</td><td>'+obj.total+'</td></tr>');
	 						i++;
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
	 								 $.each(result, function(k, v) {
	 			     data.addRow([v.name, parseFloat(v.total)]);
	 					 });

	 								 var chart = new google.visualization.LineChart(document.getElementById('linechart_annualy'));
	 		   	 	 chart.draw(data, options);
	 			}
	 	});
	 }
});
