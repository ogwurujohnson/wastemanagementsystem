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
            $result[] = $roww;
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
}