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

        $.ajax({
            type: 'POST',
            url: '../api/client/createticket',
            data: formData,
            dataType: 'json',
            encode: true
        }).done(function (data) {
            if (data.success === true) {
                document.location.href = 'cuticket.html';
                alert("Ticket Created Successfully");
            }
            else if (data.success === false) {
                document.location.href = 'google.com';
            }
			else if(data.success === "error"){
				alert("Insufficient fund in wallet, Please Do Fund your wallet to Continue.");
			}

        });

        event.preventDefault();
    });



});



