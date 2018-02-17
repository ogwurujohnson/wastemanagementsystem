
var url_string = window.location.href;
var url = new URL(url_string);
var id = url.searchParams.get("id");

$(document).ready(function(){
    getBillingInvoice();
});

function getBillingInvoice(){
    //fetch list of all billings
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                $('#clientname').html(data[0].firstname+" "+data[0].lastname);
                $('#clientaddress').html(data[0].address);
                $('#clientemail').html(data[0].email);
                $('#clientdate').html(data[0].date);
                $('#clientinvoicenumber').html(data[0].Transaction_Id);
                $('#clientamount').html("&#x20A6;"+(parseInt(data[0].Amount)-100));
                $('#grandtotal').html("&#x20A6;"+data[0].Amount);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getBillingInvoice/"+id, true);
    xmlhttp.send();
}