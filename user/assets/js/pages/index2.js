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
                period: '2018 Q2',
                iphone: 3480,
                ipad: 2102,
                itouch: 2365
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

