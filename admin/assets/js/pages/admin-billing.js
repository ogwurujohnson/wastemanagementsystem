// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getBilling();
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

function getBilling() {
    //fetch list of all billings
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
                        '<td><h5>'+data[i].firstname+" "+data[i].lastname+'</h5></td>\n' +
                        '<td><span class="text-muted">&#x20A6;'+data[i].Amount+'</span></td>\n' +
                        '<td>'+data[i].Date+'</td>\n' +
                        '<td><span class="col-green">Done</span></td>\n' +
                        '<td>\n' +
                        '<a href="invoice.html?id='+data[i].BillId+'" class="btn btn-default waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>\n' +
                        '</td>\n' +
                        '</tr>';
                    $('#tblbilling').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getBilling", true);
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


