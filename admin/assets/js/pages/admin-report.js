// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getReport();
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
    xmlhttp.open("GET", "/gafista/api/agent/getAgentDetails", true);
    xmlhttp.send();
}

function getReport() {
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
                        '<td>'+count+'</th>\n' +
                        '<td>'+data[i].firstname+" "+data[i].lastname+'</td>\n' +
                        '<td>'+data[i].Total_Property+'</td>\n' +
                        '<td>&#x20A6;'+data[i].Total_Amount+'</td>\n' +
                        '<td>'+data[i].Total_Ticket+'</td>\n' +
                        '</tr>';
                    $('#tblreport').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getReport", true);
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
    xmlhttp.open("GET", "/gafista/api/agent/logout", true);
    xmlhttp.send();
}


