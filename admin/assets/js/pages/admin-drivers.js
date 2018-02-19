// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getDriversList();
    $('#logout').click(function(){
        logout();
    });

    $('#frmEditProperty').submit(function (event) {
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
    xmlhttp.open("GET", "/gafista/api/agent/getAgentDetails", true);
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
                    count++;
                    var html = '            <li class="c_list" id="div'+data[i].id+'">\n' +
                        '                <div class="row">\n' +
                        '                    <div class="col-lg-5 col-md-5 col-10">\n' +
                        '                        <div class="control">\n' +
                        '                        </div>\n' +
                        '                        <div class="avatar">\n' +
                        '                            <img src="assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">\n' +
                        '                        </div>\n' +
                        '                        <div class="u_name">\n' +
                        '                            <h5 class="c_name">'+data[i].firstname+ " "+ data[i].lastname+'<span class="badge badge-warning bg-blue hidden-sm-down">Work</span></h5>\n' +
                        '                            <h6 class="phone"><i class="zmdi zmdi-phone"></i><span>'+data[i].phone+'</span></h6>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                    <div class="col-lg-5 col-md-6 col-12 hidden-sm-down">\n' +
                        '                        <span class="email"><a href="" title=""><i class="zmdi zmdi-email"></i>'+data[i].email+'</a></span>\n' +
                        '                        <address><i class="zmdi zmdi-pin"></i>Nigeria</address>\n' +
                        '                    </div>\n' +
                        '                    <div class="col-lg-2 col-md-1 col-2">\n' +
                        '                        <ul class="header-dropdown list-unstyled">\n' +
                        '                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>\n' +
                        '                                <ul class="dropdown-menu">\n' +
                        '                                    <li><a href="javascript:void(0);">Edit</a></li>\n' +
                        '                                    <li><a onclick="deleteClient(\''+data[i].id+'\')" href="#">Delete</a></li>\n' +
                        '                                </ul>\n' +
                        '                            </li>\n' +
                        '                        </ul>\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '                <div class="action_btn">\n' +
                        '                    <a href="javascript:void(0);" class="btn btn-default col-green"><i class="zmdi zmdi-edit"></i></a>\n' +
                        '                    <a href="#" onclick="deleteClient(\''+data[i].id+'\')" class="btn btn-default col-red"><i class="zmdi zmdi-delete"></i></a>\n' +
                        '                </div>\n' +
                        '            </li>';
                    $('#driverlist').append(html);
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

function deleteClient(id){
    var data = id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.isLoggedIn === false) {
                document.location.href = "../sign-in.html";
            } else {
                $('#div' + id).hide(100);
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/deactivateclient/"+data, true);
    xmlhttp.send();
}

function editProperty(id){
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
    xmlhttp.open("GET", "/gafista/api/agent/getSingleTicket/"+ticketid, true);
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
    xmlhttp.open("GET", "/gafista/api/agent/getPropertyGroup", true);
    xmlhttp.send();
}


