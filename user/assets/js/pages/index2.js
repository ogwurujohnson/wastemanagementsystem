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
                period: '2017 Q2',
                iphone: 3480,
                ipad: 2102,
                itouch: 2365
            }, {
                    period: '2010 Q3',
                    iphone: 4912,
                    ipad: 1969,
                    itouch: 2501
                }, {
                    period: '2011 Q3',
                    iphone: 3152,
                    ipad: 4215,
                    itouch: 2458
                }, {
                    period: '2012 Q4',
                    iphone: 7841,
                    ipad: 5967,
                    itouch: 5175
                },{
                    period: '2013 Q4',
                    iphone: 3767,
                    ipad: 3597,
                    itouch: 4512
                }, {
                    period: '2014 Q1',
                    iphone: 5148,
                    ipad: 1914,
                    itouch: 2293
                }, {
                    period: '2015 Q2',
                    iphone: 4125,
                    ipad: 3451,
                    itouch: 6124
                },{
                    period: '2016 Q3',
                    iphone: 2068,
                    ipad: 4460,
                    itouch: 2028
                }, {
                    period: '2017 Q4',
                    iphone: 6412,
                    ipad: 5713,
                    itouch: 3450
                }],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
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
$(window).on('scroll',function() {
    $('.card .sparkline').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow+400) {
            $(this).addClass("pullUp");
        }
    });
});

