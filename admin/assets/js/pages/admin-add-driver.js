// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    $('#logout').click(function(){
        logout();
    });

    $('#frmAddDriver').submit(function (event) {
        var formData = {
            'txtfirstname': $('input[name=txtfirstname]').val(),
            'txtlastname':$('input[name=txtlastname]').val(),
            'txtaddress':$('input[name=txtaddress]').val(),
            'txtphonenumber': $('input[name=txtphonenumber]').val(),
            'txtemailaddress':$('input[name=txtemailaddress]').val()
        };

        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '/gafista/api/agent/addNewDriver',
            data: formData,
            dataType: 'json',
            encode: true
        })
            .done(function (data) {
                if (data.success === "errorEmpty") {
                    console.log(data);
                    $("#feedback").html("Empty Fields!");
                    $("#feedback").css({'color':'red'});
                }
                else if (data.success === true) {
                    alert('Driver Registered Successfully!');
                }
            });
        event.preventDefault();
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


