/**
 * Created by BlackHatJohnny on 14/02/2018.
 */

// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getTicketList();
    getPropertyDropdown();
    $('#logout').click(function(){
        logout();
    });

    $('#frmEditTicket').submit(function (event) {
        var formData = {
            'txtpropertyname': $('input[name=txtpropertyname]').val(),
            'txtpropertysubject':$('input[name=txtpropertysubject]').val(),
            'ddpropertygroup':$('select[name=ddpropertygroup]').val(),
            'ddpropertystatus':$('select[name=ddpropertystatus]').val(),
            'ddpropertypriority':$('select[name=ddpropertypriority]').val(),
            'propertypickuptime':$('input[name=propertypickuptime]').val(),
            'propertyid':$('input[name=propertyid]').val()
        };

        console.log(formData);

        /*        $.ajax({
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
         else if (data.success === "success") {
         console.log(data);
         }
         });
         */
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
    xmlhttp.open("GET", "../api/client/getClientDetails", true);
    xmlhttp.send();
}



function getTicketList() {
    //fetch list of all tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                for(var i = 0; i<data.length; i++){
                    var html = '<tr id="tr'+data[i].id+'">\n' +
                        '<td><h5>'+data[i].name+'</h5></td>\n' +
                        '<td><h5>'+data[i].propertyname+'</h5></td>\n' +
                        '<td><span class="text-muted">'+data[i].subject+'</span></td>\n' +
                        '<td>'+data[i].propertygroup+'</td>\n' +
                        '<td><span class="col-green">'+data[i].status+'</span></td>\n' +
                        '<td>'+data[i].priority+'</td>\n'+
                        '<td>'+data[i].pickup_date+'</td>\n'+

                        '</tr>';
                    $('#tblticketlist').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/client/allclienttickets", true);
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
    xmlhttp.open("GET", "../api/client/logout", true);
    xmlhttp.send();
}

function deleteTicket(id){
    var data = id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                $('#tr' + id).hide(100);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/deleteTicket/"+data, true);
    xmlhttp.send();
}

function editTicket(id){
    var ticketid = id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                $('#propertyId').val(ticketid);
                $('#propertyname').val(data[0].propertyname);
                $('#propertysubject').val(data[0].subject);
                getPropertyGroup();
                $('#ddPropertyStatus').val(data[0].status);
                $('#ddPropertyPriority').val(data[0].priority);
                $('#propertypickuptime').val(data[0].pickup_date);
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getSingleTicket/"+ticketid, true);
    xmlhttp.send();
}

function getPropertyGroup() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                for(var i = 0; i < data.length; i++) {
                    var html = '<option value="'+data[0].id+'" selected>'+data[0].property_type+'</option>';
                    $('#ddPropertyGroup').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "../api/client/getPropertyGroup", true);
    xmlhttp.send();
}



