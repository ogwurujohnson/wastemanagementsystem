<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/22/18
 * Time: 5:35 AM
 */

class agent
{
    private $con = "";
    private $table = "";
    private $data = array();

    function __construct()
    {
        header('Content-Type:application/json');
        session_start();
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "wastemanagement";
        $this->con = mysqli_connect($host, $user, $pass, $db);
        $this->authUser();
    }

    public function index($formdata = '')
    {
        if ($formdata != '') {
            echo $formdata;
        } else {
            echo "Welcome to the new routing";
        }
    }

    public function allproperties()
    {
        $sql = "SELECT * FROM tblproperty";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT firstname, lastname FROM tbluser WHERE id='".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["name"] = $row1["firstname"]." ".$row1["lastname"];
            $sql1 = "SELECT property_type FROM tblpropertygroup WHERE id='".$row["propertygroup_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["propertygroupname"] = $row1['property_type'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function agentproperties($userid = '')
    {
        $id = $userid;
        $sql = "SELECT * FROM tblproperty WHERE user_id = $id";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function propertygroups()
    {
        $sql = "SELECT * FROM tblpropertygroup";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM tbluser";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllClients(){
        $sql = "SELECT user_id FROM tbllogindetails WHERE access = 'agent' AND activated = 1";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $sql1 = "SELECT * FROM tbluser WHERE id = '".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[] = $row1;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllDrivers(){
        $sql = "SELECT user_id FROM tbllogindetails WHERE access = 'driver' AND activated = 1";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $sql1 = "SELECT * FROM tbluser WHERE id = '".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[] = $row1;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllAdmins(){
        $sql = "SELECT user_id FROM tbllogindetails WHERE access = 'admin' AND activated = 1";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $sql1 = "SELECT * FROM tbluser WHERE id = '".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[] = $row1;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getReport(){
        $sql = "SELECT id, firstname, lastname FROM tbluser";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        $count = 0;
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
            $sql1 = "SELECT SUM(Amount) as Total_Amount FROM tblpayments WHERE User_Id = '".$row['id']."'";
            $res1 = mysqli_query($this->con, $sql1);
            while($row1 = mysqli_fetch_row($res1)){
                $result[$count]["Total_Amount"] = $row1[0] == null ? 0 : $row1[0];
            }
            $sql1 = "SELECT id FROM tbltickets WHERE user_id = '".$row['id']."'";
            $res1 = mysqli_query($this->con, $sql1);
            $ticketcount = 0;
            while($row1 = mysqli_fetch_row($res1)){
                $ticketcount++;
            }
            $result[$count]["Total_Ticket"] = $ticketcount;
            $sql1 = "SELECT id FROM tblproperty WHERE user_id = '".$row['id']."'";
            $res1 = mysqli_query($this->con, $sql1);
            $propertycount = 0;
            while($row1 = mysqli_fetch_row($res1)){
                $propertycount++;
            }
            $result[$count]["Total_Property"] = $propertycount;
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getWallet(){
        $sql = "SELECT id, firstname, lastname FROM tbluser";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        $count = 0;
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
            $sql1 = "SELECT balance FROM tblwallet WHERE user_id = '".$row['id']."' ORDER BY id DESC";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_row($res1);
            $result[$count]["Balance"] = $row1[0] == null ? 0 : $row1[0];

            $sql1 = "SELECT Amount, Date FROM tblpayments WHERE User_Id = '".$row['id']."' ORDER BY id DESC";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_row($res1);
            $result[$count]["lastfundadded"] = $row1[0] == null ? 0 : $row1[0];
            $result[$count]["Date"] = $row1[1] == null ? '' : $row1[1];

            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getBilling(){
        $sql = "SELECT Amount, Date, User_Id, id AS BillId FROM tblpayments ORDER BY id DESC";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        $count = 0;
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
            $sql1 = "SELECT id, firstname, lastname FROM tbluser WHERE id = '".$row["User_Id"]."'";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_row($res1);
            $result[$count]["id"] = $row1[0] == null ? '' : $row1[0];
            $result[$count]["firstname"] = $row1[1] == null ? '' : $row1[1];
            $result[$count]["lastname"] = $row1[2] == null ? '' : $row1[2];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getTimelineActivities(){
        $result = [];
        $sql = "SELECT Activity,User_Id, Date FROM tbltickettimeline ORDER BY id DESC";
        $res = mysqli_query($this->con,$sql);
        $count = 0;
        while($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT id, firstname, lastname FROM tbluser WHERE id = '".$row["User_Id"]."'";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]['firstname'] = $row1['firstname'];
            $result[$count]['lastname'] = $row1['lastname'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getBillingInvoice($billingId = ''){
        $sql = "SELECT Amount, Transaction_Id, User_Id FROM tblpayments WHERE id = '".$billingId."'";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        $count = 0;
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
            $sql1 = "SELECT id, firstname, lastname, address, email, date FROM tbluser WHERE id = '".$row["User_Id"]."'";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_row($res1);
            $result[$count]["id"] = $row1[0] == null ? '' : $row1[0];
            $result[$count]["firstname"] = $row1[1] == null ? '' : $row1[1];
            $result[$count]["lastname"] = $row1[2] == null ? '' : $row1[2];
            $result[$count]["address"] = $row1[3] == null ? '' : $row1[3];
            $result[$count]["email"] = $row1[4] == null ? '' : $row1[4];
            $result[$count]["date"] = $row1[5] == null ? '' : $row1[5];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function addNewClient(){
        if (isset($_POST['txtfirstname'])) {
            $firstname = mysqli_real_escape_string($this->con, $_POST['txtfirstname']);
            $lastname = mysqli_real_escape_string($this->con, $_POST['txtlastname']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
            $phonenumber = mysqli_real_escape_string($this->con, $_POST['txtphonenumber']);
            $email = mysqli_real_escape_string($this->con, $_POST['txtemailaddress']);

            if (!empty($firstname) && !empty($lastname) && !empty($address) && !empty($phonenumber) && !empty($email)) {
                $sql = "INSERT INTO tbluser (firstname, lastname, phone, email, address) VALUES ('$firstname','$lastname','$phonenumber','$email', '$address')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $id = mysqli_insert_id($this->con);
                    $sql = "INSERT INTO tbllogindetails (email, password, access, user_id, activated) VALUES ('$email','test','agent','$id', 0)";
                    $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                    if($res){
                        $this->data['success'] = true;
                    }else{
                        $this->data['success'] = false;
                    }
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }

    public function addNewDriver(){
        if (isset($_POST['txtfirstname'])) {
            $firstname = mysqli_real_escape_string($this->con, $_POST['txtfirstname']);
            $lastname = mysqli_real_escape_string($this->con, $_POST['txtlastname']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
            $phonenumber = mysqli_real_escape_string($this->con, $_POST['txtphonenumber']);
            $email = mysqli_real_escape_string($this->con, $_POST['txtemailaddress']);

            if (!empty($firstname) && !empty($lastname) && !empty($address) && !empty($phonenumber) && !empty($email)) {
                $sql = "INSERT INTO tbluser (firstname, lastname, phone, email, address) VALUES ('$firstname','$lastname','$phonenumber','$email', '$address')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $id = mysqli_insert_id($this->con);
                    $sql = "INSERT INTO tbllogindetails (email, password, access, user_id, activated) VALUES ('$email','test','driver','$id', 0)";
                    $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                    if($res){
                        $this->data['success'] = true;
                    }else{
                        $this->data['success'] = false;
                    }
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }


    public function addNewAdmin(){
        if (isset($_POST['txtfirstname'])) {
            $firstname = mysqli_real_escape_string($this->con, $_POST['txtfirstname']);
            $lastname = mysqli_real_escape_string($this->con, $_POST['txtlastname']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
            $phonenumber = mysqli_real_escape_string($this->con, $_POST['txtphonenumber']);
            $email = mysqli_real_escape_string($this->con, $_POST['txtemailaddress']);

            if (!empty($firstname) && !empty($lastname) && !empty($address) && !empty($phonenumber) && !empty($email)) {
                $sql = "INSERT INTO tbluser (firstname, lastname, phone, email, address) VALUES ('$firstname','$lastname','$phonenumber','$email', '$address')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $id = mysqli_insert_id($this->con);
                    $sql = "INSERT INTO tbllogindetails (email, password, access, user_id, activated) VALUES ('$email','test','admin','$id', 1)";
                    $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                    if($res){
                        $this->data['success'] = true;
                    }else{
                        $this->data['success'] = false;
                    }
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }

    public function saveEditedTicket(){
        if (isset($_POST['txtpropertysubject'])) {
            $ticketsubject = mysqli_real_escape_string($this->con, $_POST['txtpropertysubject']);
            $ticketpriority = mysqli_real_escape_string($this->con, $_POST['ddpropertypriority']);
            $ticketpropertyid = mysqli_real_escape_string($this->con, $_POST['ddpropertygroup']);
            $ticketpropertystatus = mysqli_real_escape_string($this->con, $_POST['ddpropertystatus']);
            $ticketpropertypickuptime = mysqli_real_escape_string($this->con, $_POST['propertypickuptime']);
            if (!empty($ticketsubject) && !empty($ticketpriority) && !empty($ticketpropertyid)) {
                $sql = "UPDATE tbltickets SET subject = '".$ticketsubject."', priority = '".$ticketpriority."', property_id = '".$ticketpropertyid."', status = '".$ticketpropertystatus."', pickup_date='".$ticketpropertypickuptime."' WHERE id = '".$id."'";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }

    public function deactivateclient($clientid = ''){
        $id = $clientid;
        $sql = "UPDATE tbllogindetails SET activated = 0 WHERE user_id = '$id'";
        $res = mysqli_query($this->con, $sql);
        if($res){
            $this->data["success"] = true;
        }else{
            $this->data["success"] = false;
        }
        echo json_encode($this->data);
    }

    public function deactivateadmin($clientid = ''){
        $id = $clientid;
        $sql = "UPDATE tbllogindetails SET activated = 0 WHERE user_id = '$id'";
        $res = mysqli_query($this->con, $sql);
        if($res){
            $this->data["success"] = true;
        }else{
            $this->data["success"] = false;
        }
        echo json_encode($this->data);
    }

    public function getAllPayments()
    {
        $sql = "SELECT * FROM tblpayments";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllUsersCount(){
        $result = array();
        $sql = "SELECT id FROM tbllogindetails";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllClientsCount(){
        $result = array();
        $sql = "SELECT id FROM tbllogindetails WHERE access = 'agent'";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllPaymentsCount(){
        $result = array();
        $sql = "SELECT id FROM tblpayments";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllTicketsCount(){
        $result = array();
        $sql = "SELECT id FROM tbltickets";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllOngoingTickets(){
        $result = array();
        $sql = "SELECT id FROM tbltickets WHERE status = 'ongoing'";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllPendingTickets(){
        $result = array();
        $sql = "SELECT id FROM tbltickets WHERE status = 'pending'";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getPendingTickets(){
        $result = array();
        $sql = "SELECT user_id, subject, pickup_date, address, date FROM tbltickets WHERE status = 'pending'";
        $res = mysqli_query($this->con, $sql);
        $count = 0;
        while($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT id, firstname, lastname FROM tbluser WHERE id = '".$row["user_id"]."'";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]['firstname'] = $row1['firstname'];
            $result[$count]['lastname'] = $row1['lastname'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getOngoingTickets(){
        $result = array();
        $sql = "SELECT user_id, subject, pickup_date, address, date FROM tbltickets WHERE status = 'ongoing'";
        $res = mysqli_query($this->con, $sql);
        $count = 0;
        while($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT id, firstname, lastname FROM tbluser WHERE id = '".$row["user_id"]."'";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]['firstname'] = $row1['firstname'];
            $result[$count]['lastname'] = $row1['lastname'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getDoneTickets(){
        $result = array();
        $sql = "SELECT user_id, subject, pickup_date, address, date FROM tbltickets WHERE status = 'done'";
        $res = mysqli_query($this->con, $sql);
        $count = 0;
        while($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT id, firstname, lastname FROM tbluser WHERE id = '".$row["user_id"]."'";
            $res1 = mysqli_query($this->con, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]['firstname'] = $row1['firstname'];
            $result[$count]['lastname'] = $row1['lastname'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllResolvedTickets(){
        $result = array();
        $sql = "SELECT id FROM tbltickets WHERE status = 'done'";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllPropertiesCount(){
        $result = array();
        $sql = "SELECT id FROM tblproperty";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getTotalPaymentsAmount(){
        $result = array();
        $sql = "SELECT Amount FROM tblpayments";
        $res = mysqli_query($this->con, $sql);
        $result['amount'] = 0;
        while ($row = mysqli_fetch_row($res)) {
            $result['amount'] += $row[0];
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllTicketsAmount(){
        $result = array();
        $sql = "SELECT property_id FROM tbltickets";
        $res = mysqli_query($this->con, $sql);
        $result['amount'] = 0;
        while ($row = mysqli_fetch_row($res)) {
            $sql1 = "SELECT propertygroup_id FROM tblproperty WHERE id = '".$row[0]."'";
            $res1 = mysqli_query($this->con,$sql1);
            while($row1 = mysqli_fetch_row($res1)){
                $sql2 = "SELECT property_price FROM tblpropertygroup WHERE id = '".$row1[0]."'";
                $res2 = mysqli_query($this->con,$sql2);
                $row2 = mysqli_fetch_row($res2);
                $result['amount'] += $row2[0];
            }
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAgentDetails(){
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tbluser WHERE id='".$id."'";
        $res = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_row($res);
        $result = $row;
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function alltickets()
    {
        $sql = "SELECT * FROM tbltickets";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT firstname, lastname FROM tbluser WHERE id='".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["name"] = $row1["firstname"]." ".$row1["lastname"];
            $sql1 = "SELECT property_name, propertygroup_id FROM tblproperty WHERE id='".$row["property_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["propertyname"] = $row1['property_name'];
            $sql1 = "SELECT property_type FROM tblpropertygroup WHERE id='".$row1["propertygroup_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["propertygroup"] = $row1['property_type'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function opentickets()
    {
        $sql = "SELECT * FROM tbltickets WHERE status = 'open'";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function ticketcategories()
    {
        $sql = "SELECT * FROM tblticket_category";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }


    public function agentticket($userid = '')
    {
        $id = $userid;
        $sql = "SELECT * FROM tbltickets WHERE user_id = $id ";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function addproperty()
    {
        $id = $_SESSION['userid'];
        if (isset($_POST['txtpropertyname'])) {
            $propertyname = $propertygroupid = $address = $userid = "";
            $propertyname = mysqli_real_escape_string($this->con, $_POST['txtpropertyname']);
            $propertygroupid = mysqli_real_escape_string($this->con, $_POST['ddPropertyGroup']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtpropertyaddress']);
            if (!empty($propertyname) && !empty($propertygroupid) && !empty($address)) {
                $sql = "INSERT INTO tblproperty (property_name, propertygroup_id, address, user_id) VALUES ('$propertyname','$propertygroupid','$address','$id')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);

    }

    public function addpropertygroup()
    {
        if (isset($_POST['txtpropertygroupname'])) {
            $propertytype = mysqli_real_escape_string($this->con, $_POST['txtpropertygroupname']);
            $propertyprice = mysqli_real_escape_string($this->con, $_POST['txtpropertygroupprice']);
            if (!empty($propertytype) && !empty($propertyprice)) {
                $sql = "INSERT INTO tblpropertygroup (property_type, property_price) VALUES ('$propertytype','$propertyprice') ";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }

    public function deletepropertygroup($propertygroupid = '')
    {
        $id = $propertygroupid;
        if (isset($_POST)) {

            $sql = "DELETE FROM tblpropertygroup WHERE id = '$id' ";
            $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
            if ($res) {
                $this->data['success'] = true;
            } else {
                $this->data['success'] = false;
            }
        }
        echo json_encode($this->data);
    }

    public function createticket($userid = '')
    {
        $id = $_SESSION['userid'];
        if (isset($_POST['txtticketsubject'])) {
            $ticketsubject = $ticketpriority = $ticketpropertyid = $userid = "";
            $ticketsubject = mysqli_real_escape_string($this->con, $_POST['txtticketsubject']);
            $ticketpriority = mysqli_real_escape_string($this->con, $_POST['ddticketpriority']);
            $ticketpropertyid = mysqli_real_escape_string($this->con, $_POST['ddproperty']);
            if (!empty($ticketsubject) && !empty($ticketpriority) && !empty($ticketpropertyid)) {
                $sql = "INSERT INTO tbltickets (subject,status,priority,property_id,user_id) VALUES ('$ticketsubject','pending','$ticketpriority','$ticketpropertyid','$id')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }

    public function fundwallet($userid = '')
    {
        $id = $userid;
        if (isset($_POST['txtamount'])) {
            $walletamount = mysqli_real_escape_string($this->con, $_POST['txtamount']);
            if (!empty($walletamount)) {
                $sql = "INSERT into tblwallet (amount,user_id) VALUES ('$walletamount','$id') ";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }


    /**
     *method for updating properties added by agents
     */
    public function updateproperty($propertyid = '')
    {
        $id = $propertyid;
        if (isset($_POST['txtpropertyname'])) {
            $propertyname = $propertygroupid = $address = $userid = '';
            $propertyname = mysqli_real_escape_string($this->con, $_POST['txtpropertyname']);
            $propertygroupid = mysqli_real_escape_string($this->con, $_POST['txtpropertygroupid']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
            if (!empty($propertyname) || !empty($propertygroupid) || !empty($address)) {
                $sql = "UPDATE tblproperty SET property_name = '$propertyname', propertygroup_id = '$propertygroupid', address = '$address' WHERE id = '$id' ";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
        echo json_encode($this->data);
    }

    public function deleteproperty($propertyid = '')
    {
        $id = $propertyid;
        if (isset($_POST)) {

            $sql = "DELETE FROM tblproperty WHERE id = '$id'";
            $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
            if ($res) {
                $this->data['success'] = true;
            } else {
                $this->data['success'] = false;
            }
        }
        echo json_encode($this->data);
    }

    public function deleteTicket($data){
        $id = $data;
        $sql = "DELETE FROM tbltickets WHERE id = '".$id."'";
        $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if($res){
            $this->data['success'] = true;
        }else{
            $this->data['success'] = false;
        }
        echo json_encode($this->data);
    }

    public function getSingleTicket($data){
        $ticketId = $data;
        $sql = "SELECT * FROM tbltickets WHERE id='".$ticketId."'";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
            $sql1 = "SELECT firstname, lastname FROM tbluser WHERE id='".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["name"] = $row1["firstname"]." ".$row1["lastname"];
            $sql1 = "SELECT property_name, propertygroup_id FROM tblproperty WHERE id='".$row["property_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["propertyname"] = $row1['property_name'];
            $sql1 = "SELECT property_type FROM tblpropertygroup WHERE id='".$row1["propertygroup_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["propertygroup"] = $row1['property_type'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function updateTicket($ticketId){
        $id = $ticketId;
        if (isset($_POST['txtpropertyname'])) {
            $ticketsubject = mysqli_real_escape_string($this->con, $_POST['txtpropertysubject']);
            $ticketstatus = mysqli_real_escape_string($this->con, $_POST['ddpropertystatus']);
            $ticketpriority = mysqli_real_escape_string($this->con, $_POST['ddpropertypriority']);
            $propertygroup = mysqli_real_escape_string($this->con, $_POST['ddpropertygroup']);
            $propertypickuptime = mysqli_real_escape_string($this->con, $_POST['propertypickuptime']);

            if (!empty($ticketsubject) && !empty($ticketpriority) && !empty($propertygroup) && !empty($ticketstatus) && $propertypickuptime) {
                $sql = "INSERT into tbltickets (subject,status,priority,property_id,user_id) VALUES ('$ticketsubject','pending','$ticketpriority','$ticketpropertyid','$id')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if ($res) {
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
            } else {
                $this->data['error'] = "empty";
            }
        }
    }

    public function getPropertyGroup(){
        $result = [];
        $sql = "SELECT * FROM tblpropertygroup";
        $res = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function deactivateagentaccount($userid = '')
    {
        $id = 6;
        $sql = "UPDATE tbllogindetails SET activation = '1' WHERE user_id = '$id' ";
        $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if ($res) {
            $this->data['success'] = true;
        } else {
            $this->data['success'] = false;
        }

        echo json_encode($this->data);
    }

    private function authUser()
    {
        if (isset($_SESSION['useremail']) && isset($_SESSION['userpassword'])) {
            $email = mysqli_real_escape_string($this->con, $_SESSION['useremail']);
            $password = mysqli_real_escape_string($this->con, $_SESSION['userpassword']);
            $sql = "SELECT * FROM tbllogindetails WHERE email='" . $email . "' AND password='" . $password . "' LIMIT 1";
            $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
            if ($res) {
                $this->data['isLoggedIn'] = true;
            }else{
                $this->data['isLoggedIn'] = false;
                echo json_encode($this->data);
                die();
            }
        }else{
            $this->data['isLoggedIn'] = false;
            echo json_encode($this->data);
            die();
        }
    }

    public function logout(){
        session_destroy();
    }
}

