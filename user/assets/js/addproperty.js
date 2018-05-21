/**
 * Created by BlackHatJohnny on 08/02/2018.
 */

// JavaScript source code
$(document).ready(function () {
    getPropertyGroup();
    
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

function getPropertyGroup() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                console.log(data);
                for(var i = 0; i < data.length; i++) {
                    var html = '<option value="'+data[i].id+'" selected>'+data[i].property_type+'</option>';
                    $('#ddPropertyGroup').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getPropertyGroup", true);
    xmlhttp.send();
}




