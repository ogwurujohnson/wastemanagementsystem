// JavaScript source code
$(document).ready(function(){
    getUserDetails();
    getTicketList();
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

        $.ajax({
            type: 'POST',
            url: '/gafista/api/agent/saveEditedTicket',
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
                else if (data.success === "success") {
                    alert('Ticket Edited Successfully!');
                    location.reload();
                }
            });
        event.preventDefault();
    });

    $('#editticket').on('hidden.bs.modal', function () {
        $('.modal-dialog').empty();
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
                var count = 0;
                for(var i = 0; i<data.length; i++){
                    count++;
                    var html = '<tr id="tr'+data[i].id+'">\n' +
                        '<td><span>'+count+'</span></td>'+
                        '<td><h5>'+data[i].name+'</h5></td>\n' +
                        '<td><h5>'+data[i].propertyname+'</h5></td>\n' +
                        '<td><span class="text-muted">'+data[i].subject+'</span></td>\n' +
                        '<td>'+data[i].propertygroup+'</td>\n' +
                        '<td><span class="col-green">'+data[i].status+'</span></td>\n' +
                        '<td>'+data[i].priority+'</td>\n'+
                        '<td>'+data[i].pickup_date+'</td>\n'+
                        '<td>\n' +
                        '<a href="javascript:void(0);" class="btn btn-default waves-effect waves-float waves-green" data-toggle="modal" data-target="#editticket"><i class="zmdi zmdi-edit" onclick="editTicket(\''+data[i].id+'\')"></i></a>\n' +
                        '<a href="javascript:void(0);" class="btn btn-default waves-effect waves-float waves-red"><i class="zmdi zmdi-delete" onclick="deleteTicket(\''+data[i].id+'\')"></i></a>\n' +
                        '</td>\n' +
                        '</tr>';
                    $('#tblticketlist').append(html);
                }
            }
        }
    };
    xmlhttp.open("GET", "/gafista/api/agent/alltickets", true);
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
    xmlhttp.open("GET", "/gafista/api/agent/deleteTicket/"+data, true);
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
                var html = '        <div class="modal-content">\n' +
                    '            <div class="modal-header">\n' +
                    '                <h4 class="modal-title" id="defaultModalLabel">Edit Ticket</h4>\n' +
                    '            </div>\n' +
                    '            <div class="modal-body">\n' +
                    '                <div class="form-group">\n' +
                    '                    <div class="form-line">\n' +
                    '                        <input type="text" class="form-control" placeholder="Property Name" name="txtpropertyname" id="propertyname" value="'+data[0].propertyname+'" />\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '                <div class="form-group">\n' +
                    '                    <div class="form-line">\n' +
                    '                        <input type="text" class="form-control" placeholder="Property Subject" name="txtpropertysubject" id="propertysubject" value="'+data[0].subject+'">\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '                <div class="form-group">\n' +
                    '                    <div class="form-line">\n' +
                    '                        <select class="form-control" name="ddpropertygroup" id="ddPropertyGroup">\n' +
                    '                           <option value="'+data[0].id+'" selected>'+data[0].property_type+'</option>\n'+
                    '                        </select>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '\n' +
                    '                <div class="form-group">\n' +
                    '                    <div class="form-line">\n' +
                    '                        <select class="form-control" name="ddpropertystatus" id="ddPropertyStatus">\n' +
                    '                            <option value="'+data[0].status+'" selected>'+data[0].status+'</option>\n'+
                    '                            <option value="pending">Pending</option>\n' +
                    '                            <option value="done">Done</option>\n' +
                    '                            <option value="ongoing">Ongoing</option>\n' +
                    '                        </select>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '\n' +
                    '                <div class="form-group">\n' +
                    '                    <div class="form-line">\n' +
                    '                        <select class="form-control" name="ddpropertypriority">\n' +
                    '                            <option value="'+data[0].priority+'">'+data[0].priority+'</option>'+
                    '                            <option value="high">High</option>\n' +
                    '                            <option value="medium">Medium</option>\n' +
                    '                            <option value="low">Low</option>\n' +
                    '                        </select>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '\n' +
                    '                <div class="form-group">\n' +
                    '                    <div class="form-line">\n' +
                    '                        <input type="text" class="datepicker form-control" placeholder="Pick-Up Time" name="propertypickuptime" id="propertypickuptime" value="'+data[0].pickup_date+'" />\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '                <input type="text" value="'+ticketid+'" name="propertyid" id="propertyId" hidden />\n' +
                    '            </div>\n' +
                    '            <div class="modal-footer">\n' +
                    '                <button type="submit" class="btn  btn-raised btn-info waves-effect">Save</button>\n' +
                    '                <button type="button" class="btn btn-raised btn-default waves-effect" data-dismiss="modal">CLOSE</button>\n' +
                    '            </div>\n' +
                    '        </div>';

                $('.modal-dialog').append(html);
                getPropertyGroup();
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


