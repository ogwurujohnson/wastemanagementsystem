//[custom Javascript]

//Project:	Nexa - Responsive Bootstrap 4 Template
//Version:  1.0
//Last change:  15/12/2017
//Primary use:	Nexa - Responsive Bootstrap 4 Template

//should be included in all pages. It controls some layout


$(function () {
    "use strict";  
    initSparkline();    
    getMorris('area', 'area_chart');
});


function getMorris(type, element) {
    if (type === 'area') {
        Morris.Area({
            element: element,
            data: [{
                period: '2017 Q5',
                Sales: 3480,
                Revenue: 2102,
                Profit: 2365
            }, {
                    period: '2013 Q3',
                    Sales: 4215,
                    Revenue: 4460,
                    Profit: 2028                
                },{
                    period: '2014 Q1',
                    Sales: 4215,
                    Revenue: 4460,
                    Profit: 2028
                }, {
                    period: '2015 Q4',
                    Sales: 6412,
                    Revenue: 5713,
                    Profit: 3450
                },{
                    period: '2016 Q3',
                    Sales: 4215,
                    Revenue: 4460,
                    Profit: 2028                
                },{
                    period: '2017 Q5',
                    Sales: 4215,
                    Revenue: 4460,
                    Profit: 2028                
                }],
            xkey: 'period',
            ykeys: ['Sales', 'Revenue', 'Profit'],
            labels: ['Sales', 'Revenue', 'Profit'],
            pointSize: 3,
            hideHover: 'auto',
            lineColors: ['rgba(254, 191, 15,0.3)', 'rgba(25, 161, 183, 0.3)', 'rgba(134, 139, 239, 0.3)']
        });
    }
}
//===============================================================================
function initSparkline() {
    $(".sparkline").each(function () {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });
}
//===============================================================================
$(window).scroll(function() {
    $('.card .sparkline').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow+400) {
            $(this).addClass("pullUp");
        }
    });
});
//===============================================================================
$(function () {
    $('#world-map-markers').vectorMap({
        map: 'world_mill_en',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                fill: 'rgba(210, 214, 222, 1)',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            },
            hover: {
                fill: 'rgba(255, 193, 7, 2)',
                cursor: 'pointer'
            },
            selected: {
                fill: 'yellow'
            },
            selectedHover: {}
        },
        markerStyle: {
            initial: {
                fill: '#fff',
                stroke: '#FFC107 '
            }
        },
        markers: [
            { latLng: [37.09,-95.71], name: 'America' },
            { latLng: [51.16,10.45], name: 'Germany' },
            { latLng: [-25.27, 133.77], name: 'Australia' },
            { latLng: [56.13,-106.34], name: 'Canada' },
            { latLng: [20.59,78.96], name: 'India' },
            { latLng: [55.37,-3.43], name: 'United Kingdom' },
        ]
    });
});