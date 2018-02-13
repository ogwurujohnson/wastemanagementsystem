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
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
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
        while ($row = mysqli_fetch_row($res)) {
            $result[] = $row;
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

    public function addproperty($userid = '')
    {
        $id = $userid;
        if (isset($_POST['txtpropertyname'])) {
            $propertyname = $propertygroupid = $address = $userid = "";
            $propertyname = mysqli_real_escape_string($this->con, $_POST['txtpropertyname']);
            $propertygroupid = mysqli_real_escape_string($this->con, $_POST['txtpropertygroupid']);
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

            $sql = "DELETE FROM tblproperty WHERE id = '$id' ";
            $res = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
            if ($res) {
                $this->data['success'] = true;
            } else {
                $this->data['success'] = false;
            }
        }
        echo json_encode($this->data);
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

