// JavaScript source code
$(document).ready(function () {
    $('#sign_in').submit(function (event) {
        var formData = {
            'txtUsername': $('input[name=txtemail]').val(),
            'txtPassword':$('input[name=txtpassword]').val()
        };

        $.ajax({
            type: 'POST',
            url: 'api/users/signin',
            data: formData,
            dataType: 'json',
            encode: true
        })

            .done(function (data) {
                if (data.success === "errorEmpty") {
                    console.log(data);
                    $("#status").html("Empty Fields!");
                    $("#status").css({'color':'red'});
                }
                else if (data.success === "errorUsername") {
                    console.log(data);
                    $("#status").html("Invalid Username!");
                    $("#status").css({ 'color': 'red' });
                }
                else if (data.success === "errorSelectUsername") {
                    console.log(data);
                    $("#status").html("Username Not Found!");
                    $("#status").css({ 'color': 'red' });
                }
                else if (data.success === "errorPassword") {
                    console.log(data);
                    $("#status").html("Incorrect Password!");
                    $("#status").css({ 'color': 'red' });
                }
                else if (data.success === "success") {
                    console.log(data);
                    if(data.accounttype === "agent") {
                        document.location.href = 'user/dashboard.php';
                    }else{
                        document.location.href = 'admin/dashboard.php';
                    }
                }
            });
        event.preventDefault();
    });

});


