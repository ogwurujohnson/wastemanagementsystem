$(document).ready(function(){
   getNotifications();
});

function getNotifications(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200){
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../../sign-in.html";
            } else {
                for(var i = 0; i < data.length; i++) {
                    var html = '<li>\n' +
                        '<a href="display_notifications.html">\n' +
                        '<div class="menu-info">\n' +
                        '<h4>'+data[i].Activity+'</h4>\n' +
                        '<p> <i class="material-icons">time: </i>'+data[i].Date+'</p>\n' +
                        '</div>\n' +
                        '</a>\n' +
                        '</li>';
                    $('#notify').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/agent/getNotifications", true);
    xmlhttp.send();
}
