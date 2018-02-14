// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getAllUsersCount();
    getAllPropertiesCount();
    getTotalPaymentsCount();
    getTotalPaymentsAmount();
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

function getAllUsersCount() {
    //gets total count of users
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#userscount').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllUsersCount", true);
    xmlhttp.send();
}

function getAllPropertiesCount() {
    //gets total count of properties
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#propertiescount').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllPropertiesCount", true);
    xmlhttp.send();
}

function getTotalPaymentsCount() {
    //gets total count of payments
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#paymentscount').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllPaymentsCount", true);
    xmlhttp.send();
}

function getTotalPaymentsAmount(){
    //gets total payments
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#paymentsamount').html('Total &#x20A6;'+data.amount);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getTotalPaymentsAmount", true);
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


