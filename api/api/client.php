<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/22/18
 * Time: 5:35 AM
 */

class client
{
    private $con = "";
    private $table = "";
    private $data = array();

    function __construct()
    {
        header('Content-Type:application/json');
        session_start();
        $host = "localhost";
        /*$user = "gafistac_user";
        $pass = "*rUeF16j@w)T";
        $db = "gafistac_db";*/
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

    public function getClientDetails(){
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tbluser WHERE id='".$id."'";
        $res = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_row($res);
        $result = $row;
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function totalmoneyspent(){
        $id = $_SESSION['userid'];
        $sql = "SELECT SUM(charge) AS total_charge FROM tblbilling WHERE user_id = $id ";
        $res = mysqli_query($this->con,$sql);
        $row = mysqli_fetch_assoc($res);
        $sum = $row['total_charge'];

        header('Content-Type:application/json');
        echo json_encode($sum);
    }


    public function getClientWalletDetails(){
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tblwallet WHERE user_id = '".$id."'";
        $res = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_row($res);
        $result = $row;
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function allclienttickets($userid = '')
    {
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tbltickets WHERE user_id = $id";
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



    public function allclientproperties($userid = '')
    {
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tblproperty WHERE user_id = $id";
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
            $result[$count]["propertygroup"] = $row1['property_type'];
            $count++;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function gettransactiontimeline($user = '')
    {
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tblcreditdebit WHERE user_id = $id ORDER BY date DESC LIMIT 0,2";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
            $sql1 = "SELECT firstname, lastname FROM tbluser WHERE id='".$row["user_id"]."'";
            $res1 = mysqli_query($this->con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $result[$count]["name"] = $row1["firstname"]." ".$row1["lastname"];
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


    public function clientticket($userid = '')
    {
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM tbltickets WHERE user_id = $id ";
        $res = mysqli_query($this->con, $sql);
        $result = [];
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }
    public function clientProperty(){
        $id = $_SESSION['userid'];
        $result = [];
        $sql = "SELECT * FROM tblproperty WHERE user_id = $id ";
        $res = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
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

    public function deleteProperty($data){
        $id = $data;
        $sql = "DELETE FROM tblproperty WHERE id = '".$id."'";
        $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if($res){
            $this->data['success'] = true;
        }else{
            $this->data['success'] = false;
        }
        echo json_encode($this->data);
    }

    public function getAllClientsTicketsCount($user_id = ''){
        $id = $_SESSION['userid'];
        $result = array();
        $sql = "SELECT id FROM tbltickets WHERE user_id = $id ";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllClientsPropertiesCount($user_id = ''){
        $id = $_SESSION['userid'];
        $result = array();
        $sql = "SELECT id FROM tblproperty WHERE user_id = $id";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function getAllClientReceiptsCount(){
        $id = $_SESSION['userid'];
        $result = array();
        $sql = "SELECT id FROM tblcreditdebit WHERE user_id = $id";
        $res = mysqli_query($this->con, $sql);
        $result['count'] = mysqli_num_rows($res);
        header('Content-Type:application/json');
        echo json_encode($result);
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



    public function getSingleProperty($data){
        $propertyId = $data;
        $sql = "SELECT * FROM tblproperty WHERE id='".$propertyId."'";
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
            if (!empty($ticketsubject) && !empty($ticketpriority) && !empty($ticketpropertyid)) {
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



    public function addproperty($userid = '')
    {
        $id = $_SESSION['userid'];
        if (isset($_POST['txtpropertyname'])) {
            $propertyname = $propertygroupid = $address = $userid = "";
            $propertyname = mysqli_real_escape_string($this->con, $_POST['txtpropertyname']);
            $propertygroupid = mysqli_real_escape_string($this->con, $_POST['ddpropertygroupid']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
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
        if (isset($_POST['txtpropertytype'])) {
            $propertytype = mysqli_real_escape_string($this->con, $_POST['txtpropertytype']);
            $propertyprice = mysqli_real_escape_string($this->con, $_POST['txtpropertyprice']);
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
        //also serving as our deduct method
    {
        $id = $_SESSION['userid'];
        if (isset($_POST['txtticketsubject'])) {
            $ticketsubject = $ticketpriority = $ticketpropertyid = $pickupdate = $userid = "";
            $ticketsubject = mysqli_real_escape_string($this->con, $_POST['txtticketsubject']);
            $ticketpriority = mysqli_real_escape_string($this->con, $_POST['ddticketpriority']);
            $ticketpropertyid = mysqli_real_escape_string($this->con, $_POST['ddproperty']);
            $pickupdate = mysqli_real_escape_string($this->con, $_POST['txtpickupdate']);
            if (!empty($ticketsubject) && !empty($ticketpriority) && !empty($ticketpropertyid)) {

                $sql1 = "SELECT property_name, propertygroup_id FROM tblproperty WHERE id = '" . $ticketpropertyid . "'";
                $res1 = mysqli_query($this->con, $sql1);
                $row1 = mysqli_fetch_assoc($res1);
                $sql2 = "SELECT property_price FROM tblpropertygroup WHERE id = ' " . $row1["propertygroup_id"] . " ' ";
                $res2 = mysqli_query($this->con, $sql2);
                $row2 = mysqli_fetch_assoc($res2);
                $sql7 = "SELECT id FROM tblwallet WHERE user_id = $id";
                $res7 = mysqli_query($this->con, $sql7);
                $row7 = mysqli_fetch_assoc($res7);
                $sql4 = "SELECT balance FROM tblwallet WHERE user_id = $id";
                $res4 = mysqli_query($this->con, $sql4);
                $row4 = mysqli_fetch_assoc($res4);
                if ($row4['balance'] >= $row2['property_price']) {
                    $sql5 = "UPDATE tblwallet SET balance = balance - '" . $row2["property_price"] . "' ";
                    $res5 = mysqli_query($this->con, $sql5) or die(mysqli_error($this->con));
                
                if ($res2 && $res5) {
                    $sql = "INSERT INTO tbltickets (subject,status,priority,property_id,user_id,pickup_date) VALUES ('$ticketsubject','pending','$ticketpriority','$ticketpropertyid','$id','$pickupdate')";
                    $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                    $sql3 = "INSERT INTO tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$id','$ticketsubject', 'debit', '".$row2["property_price"]."') ";
                    $res3 = mysqli_query($this->con,$sql3) or die(mysqli_error($this->con));
                    $sql8 = "INSERT into tblbilling (user_id,wallet_id,charge) VALUES ('$id','".$row7['id']."','" . $row2["property_price"] . "')";
                    $res8 = mysqli_query($this->con,$sql8) or die(mysqli_error($this->con));
                    $this->data['success'] = true;
                } else {
                    $this->data['success'] = false;
                }
				}else{
					$this->data['success'] = "error";
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




    public function deactivateclientaccount($userid = '')
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

