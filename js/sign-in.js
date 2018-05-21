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
                    if($('input[name=txtpassword]').val() === 'test' || $('input[name=txtpassword]').val() === 'Test' || $('input[name=txtpassword]').val() === 'TEST'){
                        document.location.href = 'changepassword.html';
                    }else {
                        if (data.accounttype === "admin") {
                            document.location.href = 'admin/index.html';
                        } else if (data.accounttype === "agent") {
                            document.location.href = 'user/index.html';
                        }
                    }
                }
            });
        event.preventDefault();
    });

});


