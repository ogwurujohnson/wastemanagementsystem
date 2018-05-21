// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getWallet();
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

function getWallet() {
    //fetch list of all tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                var count = 0;
                for(var i = 0; i<data.length; i++){
                    count++;
                    var html = '<tr>\n' +
                        '<td>'+count+'</td>\n' +
                        '<td>\n' +
                        '<a href="#">'+data[i].firstname+" "+data[i].lastname+'</a>\n' +
                        '</td>\n' +
                        '<td>&#x20A6;'+data[i].Balance+'</td>\n' +
                        '<td>&#x20A6;'+data[i].lastfundadded+'</td>\n' +
                        '<td>'+data[i].Date+'</td>\n' +
                        '<td>\n' +
                        '<div class="progress" >\n' +
                        '<div class="progress-bar l-green" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%;"></div>\n' +
                        '</div>\n' +
                        '</td>\n' +
                        '</tr>';
                    $('#tblwallet').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/agent/getWallet", true);
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


