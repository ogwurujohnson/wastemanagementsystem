/**
 * Created by BlackHatJohnny on 15/02/2018.
 */
// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getAllClientPropertiesCount();
    getAllClientTicketCount();
    getUserWalletDetails();
    getAllClientReceiptCount();
    getTotalSpent();
    getTransactionTimeLine();

    $('#logout').click(function(){
        logout();
    });
});

function getTotalSpent(){
    //fetch loggedin user details
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#totalspent').html('&#x20A6;'+data);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/totalmoneyspent", true);
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
                $('#email').val(data[4]);
                $('#id').val(data[0]);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getClientDetails", true);
    xmlhttp.send();
}

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
                $('#walletbalance').html('&#x20A6;'+data[2]);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getClientWalletDetails", true);
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

function getAllClientReceiptCount() {
    //gets total count of properties
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if(data.isLoggedIn === false){
                document.location.href = "../sign-in.html";
            }else{
                $('#clientreceiptcount').html(data.count);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getAllClientReceiptsCount", true);
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

function getTransactionTimeLine() {
    //fetch list of all tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                for(var i = 0; i<data.length; i++){
                    var html = '<tr id="tr'+data[i].id+'">\n' +
                        '<td><h5>'+data[i].date+'</h5></td>\n' +
                        '<td><h5>'+data[i].transaction_description+'</h5></td>\n' +
                        '<td><h5>'+data[i].transaction_type+'</h5></td>\n' +
                        '<td align="center">&#x20A6;'+data[i].amount+'</td>\n' +
                        '</tr>';
                    $('#transactiontimeline').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/client/gettransactiontimeline", true);
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