/**
 * Created by BlackHatJohnny on 08/02/2018.
 */

// JavaScript source code
$(document).ready(function () {


    $('#create_ticket').submit(function (event) {
        var formData = {
            'txtticketsubject': $('input[name=txtticketsubject]').val(),
            'ddticketpriority':$('select[name=ddticketpriority]').val(),
            'ddproperty': $('select[name=ddproperty]').val(),
            'txtpickupdate': $('input[name=txtpickupdate]').val()
        };
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '../api/client/createticket',
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
                document.location.href = 'cuticket.html';
            }
        });

        event.preventDefault();
    });
    $('#create_ticket').submit(function (event) {
        var formData = {
            'txtticketsubject': $('input[name=txtticketsubject]').val(),
            'ddticketpriority':$('select[name=ddticketpriority]').val(),
            'ddproperty': $('select[name=ddproperty]').val(),
            'txtpickupdate': $('input[name=txtpickupdate]').val()
        };
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '../api/client/deductfromwallet',
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
                document.location.href = 'cuticket.html';
            }
        });

        event.preventDefault();
    });

});



