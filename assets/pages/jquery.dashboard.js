
/**
* Theme: SimpleAdmin Admin Template
* Author: Coderthemes
* Morris Chart
*/

!function ($) {
    "use strict";

    var Dashboard = function () { };

    //creates line chart
    Dashboard.prototype.createLineChart = function (element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Line({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            fillOpacity: opacity,
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            behaveLikeLine: true,
            gridLineColor: '#eef0f2',
            hideHover: 'auto',
            lineWidth: '3px',
            pointSize: 0,
            preUnits: '$',
            resize: true, //defaulted to true
            lineColors: lineColors
        });
    },

        //creates Stacked chart
        Dashboard.prototype.createStackedChart = function (element, data, xkey, ykeys, labels, lineColors) {
            Morris.Bar({
                element: element,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                stacked: true,
                labels: labels,
                hideHover: 'auto',
                resize: true, //defaulted to true
                gridLineColor: '#eeeeee',
                barColors: lineColors
            });
        },

        Dashboard.prototype.init = function () {

            //create line chart
            var $data = [
                { y: '2008', a: 50, b: 0 },
                { y: '2009', a: 75, b: 50 },
                { y: '2010', a: 30, b: 80 },
                { y: '2011', a: 50, b: 50 },
                { y: '2012', a: 75, b: 10 },
                { y: '2013', a: 50, b: 40 },
                { y: '2014', a: 75, b: 50 },
                { y: '2015', a: 100, b: 70 }
            ];
            this.createLineChart('dashboard-line-chart', $data, 'y', ['a', 'b'], ['Mobiles', 'Tablets'], ['0.1'], ['#ffffff'], ['#999999'], ['#458bc4', '#23b195']);

            //creating Stacked chart
            var $stckedData = [
                { y: 'Январь', a: 45, b: 180 },
                { y: 'Ферваль', a: 75, b: 65 },
                { y: 'Март', a: 100, b: 90 },
                { y: 'Апрель', a: 75, b: 65 },
                { y: 'Май', a: 75, b: 65 },
                { y: 'Июнь', a: 100, b: 90 },
                { y: 'Июль', a: 100, b: 90 },
                { y: 'Август', a: 100, b: 90 },
                { y: 'Сентябрь', a: 75, b: 65 },
                { y: 'Октябрь', a: 50, b: 40 },
                { y: 'Ноябрь', a: 75, b: 65 },
                { y: 'Декабрь', a: 50, b: 40 }
            ];
            this.createStackedChart('dashboard-bar-stacked', $stckedData, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#458bc4', '#ebeff2']);

        },
        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

    //initializing
    function ($) {
        "use strict";
        $.Dashboard.init();
    }(window.jQuery);