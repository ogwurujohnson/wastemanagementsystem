// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getAllClientPropertiesCount();
    getAllClientTicketCount();
    getUserWalletDetails();
    getClientProperty();

    $('#logout').click(function(){
        logout();
    });
});

function getUserWalletDetails(){
    //fetch loggedin user details
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#walletbalance').html(data[2]);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getClientWalletDetails", true);
    xmlhttp.send();
}


function getClientProperty() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                console.log(data);
                for(var i = 0; i < data.length; i++) {
                    var html = '<option value="'+data[i].id+'" selected>'+data[i].property_name+'</option>';
                    $('#propertylist').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/client/clientProperty", true);
    xmlhttp.send();
}

function getUserDetails(){
    //fetch loggedin user details
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
                $('#phonenumber').html(data[3]);
                $('#firstname').html(data[1]);
                $('#lastname').html(data[2]);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getClientDetails", true);
    xmlhttp.send();
}

function getAllClientPropertiesCount() {
    //gets total count of properties
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#clientpropertiescount').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getAllClientsPropertiesCount", true);
    xmlhttp.send();
}

function getAllClientTicketCount() {
    //gets total count of properties
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#clientticketcount').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getAllClientsTicketsCount", true);
    xmlhttp.send();
}

function getAllUsers() {
    
}

function logout(){
    var data = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.location.href = "../sign-in.html";
        }
    };
    xmlhttp.open("GET", "../api/client/logout", true);
    xmlhttp.send();
}