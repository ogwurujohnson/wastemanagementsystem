// JavaScript source code
$(document).ready(function () {


    $('#change_password').submit(function (event) {
        if($('input[name=txtpassword]').val() != '' && $('input[name=txtretypepassword]').val() != ''){
            if($('input[name=txtretypepassword]').val() === $('input[name=txtpassword]').val()){
                var formData = {
                    'txtpassword': $('input[name=txtpassword]').val()
                };

                $.ajax({
                    type: 'POST',
                    url: 'api/users/changepassword',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })

                    .done(function (data) {
                        if (data.success) {
                            console.log(data);
                            document.location.href = 'sign-in.html';
                        }
                    });
            }else{
                alert('Password Mismatch!');
            }
        }
        event.preventDefault();
    });

});


