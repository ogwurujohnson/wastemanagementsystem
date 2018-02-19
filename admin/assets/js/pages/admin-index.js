// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getAllClientsCount();
    getAllPropertiesCount();
    getTotalPaymentsCount();
    getTotalPaymentsAmount();
    getTotalTickets();
    getOngoingTickets();
    getPendingTickets();
    getResolvedTickets();
    getAllUsersCount();
    getAllTicketsAmount();
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

function getAllClientsCount() {
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
                $('#ttusers').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllClientsCount", true);
    xmlhttp.send();
}

function getAllUsersCount(){
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
                $('#ttpaymentamount').html('&#x20A6;'+data.amount);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getTotalPaymentsAmount", true);
    xmlhttp.send();
}

function getTotalTickets() {
    //gets total tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#ticketscount').html(+data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllTicketsCount", true);
    xmlhttp.send();
}

function getAllTicketsAmount() {
    //gets total tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#ttticketamount').html('&#x20A6;'+data.amount);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllTicketsAmount", true);
    xmlhttp.send();
}

function getOngoingTickets(){
    //gets total tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#ongoingtickets').html(+data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllOngoingTickets", true);
    xmlhttp.send();
}

function getPendingTickets(){
    //gets total tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#pendingtickets').html(+data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllPendingTickets", true);
    xmlhttp.send();
}

function getResolvedTickets() {
    //gets total tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            console.log(data);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#resolvedtickets').html(+data.count);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllResolvedTickets", true);
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


