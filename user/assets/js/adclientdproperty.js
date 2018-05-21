/**
 * Created by BlackHatJohnny on 08/02/2018.
 */

// JavaScript source code
$(document).ready(function () {


    $('#add_property').submit(function (event) {
        var formData = {
            'txtpropertyname': $('input[name=txtpropertyname]').val(),
            'txtaddress':$('input[name=txtaddress]').val(),
            'ddpropertygroupid': $('select[name=ddpropertygroupid]').val()
        };
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '../api/client/addproperty',
            data: formData,
            dataType: 'json',
            encode: true
        }).done(function (data) {
            if (data.success === "errorEmpty") {
                console.log(data);
                $("#feedback").html("Empty Fields!");
                $("#feedback").css({'color':'red'});
            }
            else if (data.success === true) {
                document.location.href = 'cuproperty.html';
            }
        });
        event.preventDefault();
    });

});





