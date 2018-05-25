<?php
$amount = $_GET['amount'];
$txnref = $_GET['merchId'];
$responseType = $_GET['responseType'];
$payRef = $_GET['payRef'];
$returnedRef = $_GET['returnedRef'];
$description = $_GET['desc'];
$convertedamount = $amount/100;
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wastemanagement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 

                $userid = $_SESSION["userid"];
                
                if($responseType == "00"){
                    $sql = "UPDATE tblpayments SET status = '1', responseType = '$responseType', payReference = '$payRef', returnedReference = '$returnedRef', description = '$description' WHERE User_Id = '$userid' && status = '0' && Transaction_Id = '$txnref' ";
                    
                if ($conn->query($sql) === TRUE) {
                   
                    
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
               
            }
            if($responseType == "00" && $conn->query($sql) === TRUE){
                $query = "UPDATE tblwallet SET balance = balance + $convertedamount WHERE user_id = $userid ";
                $insert_v = mysqli_query($conn,$query);
                
                $sql1 = "INSERT into tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$userid','Wallet Funding','credit','$convertedamount')";
                $res1 = mysqli_query($conn,$sql1);
                header("Location: https://localhost/gafista/user/uvwallet.php");
            }else{}
?>