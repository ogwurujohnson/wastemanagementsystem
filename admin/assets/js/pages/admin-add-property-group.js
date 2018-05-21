// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    $('#logout').click(function(){
        logout();
    });

    $('#frmAddPropertyGroup').submit(function (event) {
        var formData = {
            'txtpropertygroupname':$('input[name=txtpropertygroupname]').val(),
            'txtpropertygroupprice':$('input[name=txtpropertygroupprice]').val()
        };

        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '../api/agent/addpropertygroup',
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
                    alert('Property Group Added Successfully!');
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
    xmlhttp.open("GET", "../api/agent/getAgentDetails", true);
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


