// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getPendingTickets();
    getOngoingTickets();
    getDoneTickets();
    getDriversList();
    $('#logout').click(function(){
        logout();
    });

    $('#assignpickup').submit(function (event) {
        var formData = {
            'ddDrivers': $('select[name=ddDrivers]').val(),
            'ddPendingTickets':$('select[name=ddPendingTickets]').val()
        };

        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '/gafista/api/agent/assignPickup',
            data: formData,
            dataType: 'json',
            encode: true
        })
            .done(function (data) {
                console.log(data);
                if (data.success === "errorEmpty") {
                    console.log(data);
                    $("#feedback").html("Empty Fields!");
                    $("#feedback").css({'color':'red'});
                }
                else if (data.success === true) {
                    alert('Driver Assigned Successfully!');
                    location.reload();
                }
            });
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
    xmlhttp.open("GET", "/gafista/api/agent/getAgentDetails", true);
    xmlhttp.send();
}

function getPendingTickets() {
        //fetch list of all tickets
        var data = '';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                data = JSON.parse(this.responseText);
                if (data.isLoggedIn === false) {
                    document.location.href = "../sign-in.html";
                } else {
                    var count = 0;
                    for(var i = 0; i<data.length; i++){
                        count++;
                        var html = '<div class="event-name b-lightred row">\n' +
                            '<div class="col-2 text-center">\n' +
                            '<h4><span>'+new Date(data[i].pickup_date)+'</span></h4>\n' +
                            '</div>\n' +
                            '<div class="col-10">\n' +
                            '<h6>'+data[i].firstname+' '+data[i].lastname+'</h6>\n' +
                            '<p>'+data[i].subject+'</p>\n' +
                            '<address><i class="zmdi zmdi-pin"></i>'+data[i].address+'</address>\n' +
                            '</div>\n' +
                            '</div>';
                        $('#pending-events').append(html);
                        $('#ddPendingTickets').append('<option value="'+data[i].id+'">'+data[i].subject+'</option>')
                    }
                }
            }
        };
        xmlhttp.open("GET", "/gafista/api/agent/getPendingTickets", true);
        xmlhttp.send();
}

function getOngoingTickets() {
    //fetch list of all tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                var count = 0;
                for(var i = 0; i<data.length; i++){
                    count++;
                    var html = '<div class="event-name b-primary row">\n' +
                        '<div class="col-2 text-center">\n' +
                        '<h4><span>'+new Date(data[i].pickup_date)+'</span></h4>\n' +
                        '</div>\n' +
                        '<div class="col-10">\n' +
                        '<h6>'+data[i].firstname+' '+data[i].lastname+'</h6>\n' +
                        '<p>'+data[i].subject+'</p>\n' +
                        '<address><i class="zmdi zmdi-pin"></i>'+data[i].address+'</address>\n' +
                        '</div>\n' +
                        '</div>';
                    $('#ongoing-events').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getOngoingTickets", true);
    xmlhttp.send();
}

function getDoneTickets() {
    //fetch list of all tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                var count = 0;
                for(var i = 0; i<data.length; i++){
                    count++;
                    var html = '<div class="event-name b-greensea row">\n' +
                        '<div class="col-2 text-center">\n' +
                        '<h4><span>'+new Date(data[i].pickup_date)+'</span></h4>\n' +
                        '</div>\n' +
                        '<div class="col-10">\n' +
                        '<h6>'+data[i].firstname+' '+data[i].lastname+'</h6>\n' +
                        '<p>'+data[i].subject+'</p>\n' +
                        '<address><i class="zmdi zmdi-pin"></i>'+data[i].address+'</address>\n' +
                        '</div>\n' +
                        '</div>';
                    $('#done-events').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getDoneTickets", true);
    xmlhttp.send();
}

function getDriversList() {
    //fetch list of all tickets
    var data = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                var count = 0;
                for(var i = 0; i<data.length; i++){
                    $('#ddDrivers').append('<option value="'+data[i].id+'">'+data[i].firstname+' '+data[i].lastname+'</option>');
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/getAllDrivers", true);
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
    xmlhttp.open("GET", "/gafista/api/agent/logout", true);
    xmlhttp.send();
}


