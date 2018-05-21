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
        session_start();
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "wastemanagement";
        $this->con = mysqli_connect($host, $user, $pass, $db);
        
    }

    public function index(){
        $data["response"] = "success";
        echo json_encode($data);
    }

    public function signin(){
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
                    $sql="SELECT * FROM tbllogindetails WHERE email='".$userName."' AND password='".$userPassword."' AND activated='1' LIMIT 1";
                    $res=mysqli_query($this->con,$sql) or die(mysqli_error($this->con));
                    if(mysqli_num_rows($res)==1){
                        $row = mysqli_fetch_assoc($res);
                        $_SESSION['userid']=$row['user_id'];
                        $_SESSION['accountype']=$row['access'];
                        $_SESSION['useremail'] = $row['email'];
                        $_SESSION['userpassword'] = $row['password'];

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

    public function signup(){
        $data = array();
        if(isset($_POST['txtemail'])) {
            $firstname = $lastname = $phone = $email = "";
            $firstname = mysqli_real_escape_string($this->con, $_POST['txtfirstname']);
            $lastname = mysqli_real_escape_string($this->con, $_POST['txtlastname']);
            $phone = mysqli_real_escape_string($this->con, $_POST['txtphonenumber']);
            $email = mysqli_real_escape_string($this->con, $_POST['txtemail']);
            $password = mysqli_real_escape_string($this->con, $_POST['txtfirstpassword']);
            $password2 = mysqli_real_escape_string($this->con, $_POST['txtsecondpassword']);

            if(!empty($email) && !empty($phone) && !empty($firstname) && !empty($lastname) && !empty($password)) {
                $sql = "SELECT email FROM tbllogindetails WHERE email='" . $email . "'";
                $checkdb = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
                if (mysqli_num_rows($checkdb) < 1) {
                    if ($password2 != $password) {
                        $data['success'] = "password_mismatch";
                    } else {
                        $sql = "INSERT INTO tbluser (firstname, lastname, phone, email) VALUES ('$firstname','$lastname','$phone','$email')";
                        $res = mysqli_query($this->con, $sql);
                        if ($res) {
                            $id = mysqli_insert_id($this->con);
                            $sql = "INSERT INTO tbllogindetails (email, password, access, user_id) VALUES ('$email','$password','agent','$id')";
                            $res = mysqli_query($this->con, $sql);
                            $sql1 = "INSERT INTO tblwallet (user_id) VALUES ('$id')";
                            $res1 = mysqli_query($this->con, $sql1);
                            if ($res) {
                                $data['success'] = true;
                            } else {
                                $data['success'] = false;
                            }
                        } else {
                            $data['success'] = false;
                        }
                    }
                }
                else{
                        $data['success'] = "errorEmail";
                }
            }else{
                    $data['success'] = "errorEmpty";
            }
        }
        echo json_encode($data);
    }
    
        public function changepassword(){
        $result = array();
        if(isset($_POST['txtpassword'])) {
            $password = "";
            $password = mysqli_real_escape_string($this->con, $_POST['txtpassword']);
            $id = $_SESSION['userid'];
            if(!empty($password)){
                $sql = "UPDATE tbllogindetails SET password = '$password' WHERE user_id='$id'";
                $res = mysqli_query($this->con, $sql);
                if($res){
                    $result['success'] = true;
                }else{
                    $result['success'] = false;
                }
            }else{
                $result['success'] = false;
            }
        }
        echo json_encode($result);
    }
    
}