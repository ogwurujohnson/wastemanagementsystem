// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getTimelineActivities();
    $('#logout').click(function(){
        logout();
    });
});

function getUserDetails(){
    //fetch logged in agent details
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#username').html(data[1]+" "+data[2]);
                $('#useremail').html(data[4]);
            }
        }
    };
    xmlhttp.open("GET", "../api/agent/getAgentDetails", true);
    xmlhttp.send();
}

function getTimelineActivities() {
    //fetch timeline activities
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                for(var i = 0; i < data.length; i++){
                    var html = '<li>\n' +
                        '<time class="cbp_tmtime" datetime="2017-11-04T18:30"><span class="hidden">'+data[i].Date+'</span></time>\n' +
                        '<div class="cbp_tmicon"><i class="zmdi zmdi-account"></i></div>\n' +
                        '<div class="cbp_tmlabel empty"> <span>'+data[i].Activity+' by '+data[i].firstname+' '+data[i].lastname+'</span> </div>\n' +
                        '</li>';
                    $('#timeline').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/agent/getTimelineActivities", true);
    xmlhttp.send();
}

function logout(){
    var data = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.location.href = "../sign-in.html";
        }
    };
    xmlhttp.open("GET", "../api/agent/logout", true);
    xmlhttp.send();
}


