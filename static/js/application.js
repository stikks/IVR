var app = angular.module('mainApp', []);

app.config(function ($interpolateProvider) {
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

app.controller('UploadController', function ($scope, $location) {
    $scope.files = [];
    $scope.upload = function () {
        $.post($location.$$absUrl,
            $scope.files, function (data, status) {
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
        Object.keys(response.data.today).map(function (key, index) {
            $scope.response.today.push(response.data.today[key][0]);
            $scope.response.totalToday += response.data.today[key][0].cdr_count
        });

        Object.keys(response.data.yesterday).map(function (key, index) {
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

app.controller("ReportController", function ($scope) {

    function getDayName(dateString) {
        return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(dateString).getDay()];
    }

    function buildData(data) {
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


    $scope.init = function () {

        var camp_data = {"data": [], "advert_data": [], "clicked_data": []};

        $.get("http://voice.atp-sevas.com:4043/api/no_of_campaign", function (data, status) {
            // Object.keys(data.result).map(function(key, index) {
            //     $scope.response.data.push(data.result[key][0]);
            // });
            Object.keys(data.result).map(function (key, index) {
                var temp_object = {"name": data.result[key][0].campaign_name, "data": [0, 0, 0, 0, 0, 0, 0]};
                var temp = data.result[key];
                temp.map(function (i, j) {
                    var pos = new Date(temp[j].created_at).getDay();
                    temp_object['data'][pos] = temp[j].cdr_count;
                });

                camp_data.data.push(temp_object);
            });

            var cam_data = {
                "categories": ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
                "text": "Call Records over a week",
                "subtitle": "All campaigns",
                "yaxis_text": "Call Record",
                "series": camp_data.data
            };
            $('#camp').highcharts(buildData(cam_data));

            Object.keys(data.result).map(function (key, index) {
                var advert_object = {"name": data.result[key][0].campaign_name, "data": [0, 0, 0, 0, 0, 0, 0]};
                var _object = data.result[key];
                _object.map(function (i, j) {
                    var pos = new Date(_object[j].created_at).getDay();
                    advert_object['data'][pos] = _object[j].impression_count;
                });

                camp_data.advert_data.push(advert_object);
            });

            var advert_data = {
                "categories": ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
                "text": "Adverts played/Call Impressions over a week",
                "subtitle": "All campaigns",
                "yaxis_text": "Call Impressions",
                "series": camp_data.advert_data
            };
            $('#success').highcharts(buildData(advert_data));

            // clicked through rate
            Object.keys(data.result).map(function (key, index) {
                var clicked_object = {"name": data.result[key][0].campaign_name, "data": [0, 0, 0, 0, 0, 0, 0]};
                var c_object = data.result[key];
                c_object.map(function (i, j) {
                    var pos = new Date(c_object[j].created_at).getDay();
                    clicked_object['data'][pos] = c_object[j].success_count;
                });

                camp_data.clicked_data.push(clicked_object);
            });

            var clicked_data = {
                "categories": ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
                "text": "Adverts played/Call Impressions over a week",
                "subtitle": "All campaigns",
                "yaxis_text": "Call Impressions",
                "series": camp_data.clicked_data
            };
            $('#clicked').highcharts(buildData(clicked_data));

            // $('#clicked').highcharts({
            //     title: {
            //         text: 'Click Through Rate Bar chat',
            //         x: -20 //center
            //     },
            //     subtitle: {
            //         text: 'ivr',
            //         x: -20
            //     },
            //     xAxis: {
            //         categories: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun']
            //     },
            //     yAxis: {
            //         title: {
            //             text: 'Counts'
            //         },
            //         plotLines: [{
            //             value: 0,
            //             width: 1,
            //             color: '#808080'
            //         }]
            //     },
            //     tooltip: {
            //         valueSuffix: ''
            //     },
            //     legend: {
            //         layout: 'vertical',
            //         align: 'right',
            //         verticalAlign: 'middle',
            //         borderWidth: 0
            //     },
            //     series: [{
            //         name: 'Follow Through',
            //         data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
            //     }
            //     ]
            // });
        });


        // $.get("http://voice.atp-sevas.com:4043/api/elasticsearch/statuses/all", function (data, status) {
        //     // Object.keys(data.result).map(function(key, index) {
        //     //     $scope.response.data.push(data.result[key][0]);
        //     // });
        //     Object.keys(data.message).map(function (key, index) {
        //         var temp_object = {"name": data.result[key][0].campaign_name, "data": [0, 0, 0, 0, 0, 0, 0]};
        //         var temp = data.result[key];
        //         temp.map(function (i, j) {
        //             var pos = new Date(temp[j].created_at).getDay();
        //             temp_object['data'][pos] = temp[j].cdr_count;
        //         });
        //
        //         camp_data.data.push(temp_object);
        //     });
        //
        //     var cam_data = {
        //         "categories": ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
        //         "text": "Call Records over a week",
        //         "subtitle": "All campaigns",
        //         "yaxis_text": "Call Record",
        //         "series": camp_data.data
        //     };
        //     $('#success').highcharts({
        //         chart: {
        //             type: 'bar'
        //         },
        //         title: {
        //             text: 'All Campaign Call Records'
        //         },
        //         subtitle: {
        //             text: ''
        //         },
        //         xAxis: {
        //             categories: Object.keys(data.message),
        //             title: {
        //                 text: null
        //             }
        //         },
        //         yAxis: {
        //             min: 0,
        //             title: {
        //                 text: 'Call Records',
        //                 align: 'high'
        //             },
        //             labels: {
        //                 overflow: 'justify'
        //             }
        //         },
        //         tooltip: {
        //             valueSuffix: ' thousands'
        //         },
        //         plotOptions: {
        //             bar: {
        //                 dataLabels: {
        //                     enabled: true
        //                 }
        //             }
        //         },
        //         legend: {
        //             layout: 'vertical',
        //             align: 'right',
        //             verticalAlign: 'top',
        //             x: -40,
        //             y: 80,
        //             floating: true,
        //             borderWidth: 1,
        //             backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        //             shadow: true
        //         },
        //         credits: {
        //             enabled: false
        //         },
        //         series: [{
        //             name: 'Year 1800',
        //             data: [107, 31, 635, 203, 2]
        //         }]
        //     });
        // });
    };
});