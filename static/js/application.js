var app = angular.module('mainApp', []);

app.controller("ReportController", function($scope){

	$scope.buildData(data) {
		return {
			title: {
	            text: data.text,
	            x: -20 //center
	        },
	        subtitle: {
	            text: data.subtitle,
	            x: -20
	        },
	        xAxis: {
	            categories: data.categories
	        },
	        yAxis: {
	            title: {
	                text: data.yaxis_text
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: data.series
	    }
	}

	$scope.init = function() {
		$('#camp').highcharts({
	        title: {
	            text: 'No of Campaigns over a period',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'ivr',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat','Sun']
	        },
	        yAxis: {
	            title: {
	                text: 'Counts'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	            name: 'Counts',
	            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
	        }
	        ]
	    });

		$('#success').highcharts({
	        title: {
	            text: 'Success/Failure Impressions',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'ivr',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat','Sun']
	        },
	        yAxis: {
	            title: {
	                text: 'Counts'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	                name: 'Success',
	                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
	            }, {
	                name: 'Failed',
	                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8]
	            }
	        ]
	    });

		$('#time_based').highcharts({
	        title: {
	            text: 'Time based on progress',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'ivr',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat','Sun']
	        },
	        yAxis: {
	            title: {
	                text: 'Counts'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	                name: 'Success',
	                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
	            }, {
	                name: 'Failed',
	                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8]
	            }
	        ]
	    });

		$('#no_time').highcharts({
	        title: {
	            text: 'No of time an advert was played Bar chat',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'ivr',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat','Sun']
	        },
	        yAxis: {
	            title: {
	                text: 'Counts'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	                name: 'Played',
	                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
	            }, {
	                name: 'Listened',
	                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8]
	            }
	        ]
	    });

		$('#flw_tru').highcharts({
	        title: {
	            text: 'Click Through Rate Bar chat',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'ivr',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat','Sun']
	        },
	        yAxis: {
	            title: {
	                text: 'Counts'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	                name: 'Follow Through',
	                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
	            }
	        ]
	    });

	    $('#clicked').highcharts({
	        title: {
	            text: 'Click Through Rate Bar chat',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'ivr',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat','Sun']
	        },
	        yAxis: {
	            title: {
	                text: 'Counts'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	                name: 'Follow Through',
	                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
	            }
	        ]
	    });
	}

	$scope.getCampaigns = function() {
		$.get("", function(data, status){
	        alert("Data: " + data + "\nStatus: " + status);
	        $('#camp').highcharts({
	        	buildData(data);
	        })
	        
	    });
	}
})