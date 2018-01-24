<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/24/18
 * Time: 12:50 AM
 */

class users
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

    public function index(){

    }

    public function signin(){
        session_start();
        $data = array();
        if(isset($_POST['txtemail'])){
            $userName = $userPassword = " ";
            $userName = mysqli_real_escape_string($this->con, $_POST['txtemail']);
            $userPassword = mysqli_real_escape_string($this->con, $_POST['txtpassword']);

            if(!empty($userName) && !empty($userPassword)){
                $sql = "SELECT email FROM tbllogindetails WHERE email='".$userName."'";
                $checkdb = mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
                if(mysqli_num_rows($checkdb)>=1){
                    $password = $userPassword;
                    $userPassword = $password;
                    $sql="SELECT * FROM tbllogindetails WHERE email='".$userName."' AND password='".$userPassword."' LIMIT 1";
                    $res=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
                    if(mysqli_num_rows($res)==1){
                        $row = mysqli_fetch_assoc($res);
                        $_SESSION['userid']=$row['user_id'];
                        $_SESSION['accountype']=$row['access'];

                        mysqli_close($this->con);
                        $data['accounttype'] = $_SESSION['accountype'];
                        $data['success'] = "success";
                    }
                    else{
                        $data['success']="errorPassword";
                    }
                }
                else{
                    $data['success'] = "errorSelectUsername";
                }
            }
            else{
                $data['success'] = "errorEmpty";
            }

        }
        else{
            header ('Location: index.php');
            exit();
        }
        echo json_encode($data);
    }
}