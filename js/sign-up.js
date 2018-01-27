// JavaScript source code
$(document).ready(function () {


    $('#sign_up').submit(function (event) {
        var formData = {
            'txtfirstname': $('input[name=txtfirstname]').val(),
            'txtlastname':$('input[name=txtlastname]').val(),
            'txtphonenumber': $('input[name=txtphonenumber]').val(),
            'txtemail':$('input[name=txtemail]').val(),
            'txtfirstpassword': $('input[name=txtfirstpassword]').val(),
            'txtsecondpassword':$('input[name=txtsecondpassword]').val()
        };
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: 'api/users/signup',
            data: formData,
            dataType: 'json',
            encode: true
        }).done(function (data) {
                if (data.success === "errorEmpty") {
                    console.log(data);
                    $("#feedback").html("Empty Fields!");
                    $("#feedback").css({'color':'red'});
                }
                else if (data.success === "errorEmail") {
                    console.log(data);
                    $("#feedback").html("Email already registered!");
                    $("#feedback").css({ 'color': 'red' });
                }
                else if (data.success === "password_mismatch") {
                    console.log(data);
                    $("#feedback").html("Password mismatch!");
                    $("#feedback").css({ 'color': 'red' });
                }
                else if (data.success === true) {
                    document.location.href = 'sign-in.html';
                }
            });
        event.preventDefault();
    });

});


