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

    function __construct(){
        header('Content-Type:application/json');
        session_start();
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "wastemanagement";
        $this->con = mysqli_connect($host,$user,$pass,$db);
    }

    public function index($formdata = ''){
        if($formdata != ''){
            echo $formdata;
        }else{
            echo "Welcome to the new routing";
        }
    }

    public function allproperties(){
        $sql = "SELECT * FROM tblproperty";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function agentproperties($formdata = ''){
        $sql = "SELECT * FROM tblproperty WHERE user_id = $formdata";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function propertygroups(){
        $sql = "SELECT * FROM tblpropertygroup";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function allagents(){
        $sql = "SELECT * FROM tbluser";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function alltickets(){
        $sql = "SELECT * FROM tbltickets";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function opentickets(){
        $sql = "SELECT * FROM tbltickets WHERE status = 'open'";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function ticketcategories(){
        $sql = "SELECT * FROM tblticket_category";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    
    public function agentticket($formdata=''){
        $sql = "SELECT * FROM tbltickets WHERE user_id = $formdata ";
        $res = mysqli_query($this->con,$sql);
        $result = [];
        while($row = mysqli_fetch_row($res)){
            $result[] = $row;
        }
        header('Content-Type:application/json');
        echo json_encode($result);
    }

    public function addproperty($userid = ''){
        $data = array();
        $id = $userid;
        if (isset($_POST['txtpropertyname'])) {
            $propertyname = $propertygroupid = $address = $userid = "";
            $propertyname = mysqli_real_escape_string($this->con, $_POST['txtpropertyname']);
            $propertygroupid = mysqli_real_escape_string($this->con, $_POST['txtpropertygroupid']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
            if(!empty($propertyname) && !empty($propertygroupid) && !empty($address)){
                $sql = "INSERT INTO tblproperty (property_name, propertygroup_id, address, user_id) VALUES ('$propertyname','$propertygroupid','$address','$id')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if($res){
                    $data['success'] = true;
                }
                else{
                    $data['success'] = false;
                }
            }else{
                $data['error'] = "empty";
            }
        }
        echo json_encode($data);

    }

    public function addpropertygroup(){
        $data = array();
        if(isset($_POST['txtpropertytype'])){
            $propertytype = mysqli_real_escape_string($this->con, $_POST['txtpropertytype']);
            $propertyprice = mysqli_real_escape_string($this->con, $_POST['txtpropertyprice']);
            if(!empty($propertytype) && !empty($propertyprice)){
                $sql = "INSERT INTO tblpropertygroup (property_type, property_price) VALUES ('$propertytype','$propertyprice') ";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if($res){
                    $data['success'] = true;
                }
                else{
                    $data['success'] = false;
                }
            }else{
                $data['error'] = "empty";
            }
        }
        echo json_encode($data);
    }

    public function deletepropertygroup($propertygroupid = ''){
        $data = array();
        $id = 5;
        if(isset($_POST)){

            $sql = "DELETE FROM tblpropertygroup WHERE id = '$id' ";
            $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
            if($res){
                $data['success'] = true;
            }
            else{
                $data['success'] = false;
            }
        }
        echo json_encode($data);
    }

    public function createticket($userid = ''){
        $data = array();
        $id = $userid;
        if (isset($_POST['txtticketsubject'])){
            $ticketsubject = $ticketpriority = $ticketpropertyid = $userid = "";
            $ticketsubject = mysqli_real_escape_string($this->con, $_POST['txtticketsubject']);
            $ticketpriority = mysqli_real_escape_string($this->con, $_POST['ddticketpriority']);
            $ticketpropertyid = mysqli_real_escape_string($this->con, $_POST['ddproperty']);
            if(!empty($ticketsubject) && !empty($ticketpriority) && !empty($ticketpropertyid)){
                $sql = "INSERT into tbltickets (subject,status,priority,property_id,user_id) VALUES ('$ticketsubject','pending','$ticketpriority','$ticketpropertyid','$id')";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if($res){
                    $data['success'] = true;
                }
                else{
                    $data['success'] = false;
                }
            }else{
                $data['error'] = "empty";
            }
        }
        echo json_encode($data);
    }

    public function fundwallet($userid = ''){
        $data = array();
        $id = 6;
        if(isset($_POST['txtamount'])){
            $walletamount = mysqli_real_escape_string($this->con, $_POST['txtamount']);
            if(!empty($walletamount)){
                $sql = "INSERT into tblwallet (amount,user_id) VALUES ('$walletamount','$id') ";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if($res){
                    $data['success'] = true;
                }
                else{
                    $data['success'] = false;
                }
            }else{
                $data['error'] = "empty";
            }
        }
        echo json_encode($data);
    }



    /**
     *method for updating properties added by agents
     */
    public function updateproperty($propertyid = ''){
        $data = array();
        $id = 2;
        if(isset($_POST['txtpropertyname'])){
            $propertyname = $propertygroupid = $address = $userid = '';
            $propertyname = mysqli_real_escape_string($this->con, $_POST['txtpropertyname']);
            $propertygroupid = mysqli_real_escape_string($this->con, $_POST['txtpropertygroupid']);
            $address = mysqli_real_escape_string($this->con, $_POST['txtaddress']);
            if(!empty($propertyname) || !empty($propertygroupid) || !empty($address)){
                $sql = "UPDATE tblproperty SET property_name = '$propertyname', propertygroup_id = '$propertygroupid', address = '$address' WHERE id = '$id' ";
                $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if($res){
                    $data['success'] = true;
                }
                else{
                    $data['success'] = false;
                }
            }else{
                $data['error'] = "empty";
            }
        }
        echo json_encode($data);
    }

    public function deleteproperty($propertyid = ''){
        $data = array();
        $id = 2;
        if(isset($_POST)){

            $sql = "DELETE FROM tblproperty WHERE id = '$id' ";
            $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
            if($res){
                $data['success'] = true;
            }
            else{
                $data['success'] = false;
            }
        }
        echo json_encode($data);
    }

    public function deactivateagentaccount($userid = ''){
        $data = array();
        $id = 6;
        $sql = "UPDATE tbllogindetails SET activation = '1' WHERE user_id = '$id' ";
        $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if($res){
            $data['success'] = true;
        }
        else{
            $data['success'] = false;
        }
        
        echo json_encode($data);
    }

    


}

