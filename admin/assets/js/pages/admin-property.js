// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getPropertyList();
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

function getPropertyList() {
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
                    var html = '<tr id="tr'+data[i].id+'">\n' +
                        '<td><span>'+count+'</span></td>\n' +
                        '<td><h5>'+data[i].name+'</h5></td>\n' +
                        '<td><span>'+data[i].property_name+'</span></td>\n' +
                        '<td>'+data[i].propertygroupname+'</td>\n' +
                        '<td><span>'+data[i].address+'</span></td>\n' +
                        '<td><span>'+data[i].date+'</span></td>\n' +
                        '<td>\n' +
                        '<a href="javascript:void(0);" class="btn btn-default waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>\n' +
                        '<a href="javascript:void(0);" class="btn btn-default waves-effect waves-float waves-red"><i class="zmdi zmdi-delete" onclick="deleteProperty(\''+data[i].id+'\')"></i></a>\n' +
                        '</td>\n' +
                        '</tr>';
                    $('#tblpropertylist').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/allproperties", true);
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

function deleteProperty(id){
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
    xmlhttp.open("GET", "/gafista/api/agent/deleteproperty/"+data, true);
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


