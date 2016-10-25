var app = angular.module('mainApp', []);

app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

app.directive('ngFileModel', ['$parse', function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, element, attrs) {
			var model = $parse(attrs.ngFileModel);
			var isMultiple = attrs.multiple;
			var modelSetter = model.assign;
			element.bind('change', function () {
				var values = [];
				angular.forEach(element[0].files, function (item) {
					var value = {
						// File Name
						name: item.name,
						//File Size
						size: item.size,
						//File URL to view
						url: URL.createObjectURL(item),
						// File Input Value
						_file: item
					};
					values.push(value);
				});
				scope.$apply(function () {
					if (isMultiple) {
						modelSetter(scope, values);
					} else {
						modelSetter(scope, values[0]);
					}
				});
			});
		}
	};
}]);

app.controller('UploadController', function($scope, $location) {
	$scope.files = [];
	$scope.upload=function(){
        $.post($location.$$absUrl,
            $scope.files,function (data, status) {
                console.log(data);
                console.log(status);
            });

	};
});

app.controller('FileCtrl', function ($scope) {

    function filterAttr(value) {
        return value.username == $scope.username;
    }

    $scope.init = function (data, username) {

        $scope.username = username;
        $scope.etisalat = false;
        $scope.tm30 = false;
        $scope.all = false;

        if (username == 'etisalat') {
            $scope.etisalat = true;
        }
        else if (username == 'tm30') {
            $scope.tm30 = true;
        }
        else {
            $scope.all = true
        }

        $scope.data_bank = data;

        if (username != 'all') {
            $scope.data = $scope.data_bank.filter(function (value) {
                return value.username == $scope.username;
            });
        }
        else {
            $scope.data = data;
        }
	};


    $scope.changeActive = function (value) {
        $scope.username = value;
        $scope.etisalat = false;
        $scope.tm30 = false;
        $scope.all = false;

        if (value == 'etisalat') {
            $scope.etisalat = true;
        }
        else if (value == 'tm30') {
            $scope.tm30 = true;
        }
        else {
            $scope.all = true
        }

        if (value != 'all') {
            $scope.data = $scope.data_bank.filter(function (value) {
                return value.username == $scope.username;
            });
        }
        else {
            $scope.data = $scope.data_bank;
        }
        $scope.$apply();
    };
});


app.controller('HomeController', function ($scope, $http) {

	function filterAttr(value) {
		return value.username == $scope.username;
	}

    $scope.response = {"today": [], "yesterday": [], "totalToday": 0, "totalYday": 0};

    $http({
        method: 'GET',
        url: 'http://voice.atp-sevas.com:4043/api/elasticsearch/data'
    }).then(function successCallback(response) {
        Object.keys(response.data.today).map(function(key, index) {
            $scope.response.today.push(response.data.today[key][0]);
            $scope.response.totalToday += response.data.today[key][0].cdr_count
        });

        Object.keys(response.data.yesterday).map(function(key, index) {
            $scope.response.yesterday.push(response.data.yesterday[key][0]);
            $scope.response.totalYday += response.data.yesterday[key][0].cdr_count
        });

    }, function errorCallback(err) {
        console.log(err);
    });

	$scope.init = function (data, username) {

		$scope.username = username;
		$scope.etisalat = false;
		$scope.tm30 = false;
		$scope.all = false;

		if (username == 'etisalat') {
			$scope.etisalat = true;
		}
		else if (username == 'tm30') {
			$scope.tm30 = true;
		}
		else {
			$scope.all = true
		}

		$scope.campaigns_bank = data;

		if (username != 'all') {
			$scope.campaigns = $scope.campaigns_bank.filter(function (value) {
				return value.username == $scope.username;
			});
		}
		else {
			$scope.campaigns = data;
		}

        $scope.active_campaigns = $scope.campaigns.filter(function (val) {
            return val.is_active = true
        });

	};

	$scope.changeActive = function (value) {
		$scope.username = value;
		$scope.etisalat = false;
		$scope.tm30 = false;
		$scope.all = false;

		if (value == 'etisalat') {
			$scope.etisalat = true;
		}
		else if (value == 'tm30') {
			$scope.tm30 = true;
		}
		else {
			$scope.all = true
		}

		if (value != 'all') {
			$scope.data = $scope.data_bank.filter(function (value) {
				return value.username == $scope.username;
			});
		}
		else {
			$scope.data = $scope.data_bank;
		}
		$scope.$apply();
	};
});

app.controller("ReportController", function($scope) {

	$scope.buildData = function (data) {
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
	};

    $scope.getCampaigns = function() {
        $.get("http://voice.atp-sevas.com:4043/api/no_campaign", function(data, status){
            console.log(data);
            // $('#camp').highcharts({
            // 	//buildData(data)
            // })

        });
    };

	$scope.init = function() {
		$scope.getCampaigns();
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
	};
});