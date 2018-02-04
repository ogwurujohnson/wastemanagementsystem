// JavaScript source code
$(document).ready(function () {


    $('#sign_in').submit(function (event) {
        var formData = {
            'txtemail': $('input[name=txtemail]').val(),
            'txtpassword':$('input[name=txtpassword]').val()
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
                    $("#feedback").html("Empty Fields!");
                    $("#feedback").css({'color':'red'});
                }
                else if (data.success === "errorUsername") {
                    console.log(data);
                    $("#feedback").html("Invalid Username!");
                    $("#feedback").css({ 'color': 'red' });
                }
                else if (data.success === "errorSelectUsername") {
                    console.log(data);
                    $("#feedback").html("Username Not Found!");
                    $("#feedback").css({ 'color': 'red' });
                }
                else if (data.success === "errorPassword") {
                    console.log(data);
                    $("#feedback").html("Incorrect Password!");
                    $("#feedback").css({ 'color': 'red' });
                }
                else if (data.success === "success") {
                    console.log(data);
                    if(data.accounttype === "admin") {
                        document.location.href = 'admin/index.html';
                    }else{
                        document.location.href = 'user/index.html';
                    }
                }
            });
        event.preventDefault();
    });

});


