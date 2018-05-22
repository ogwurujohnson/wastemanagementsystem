<?php




session_start();



$subpdtid = 1076; // SANDBOX
//$subpdtid = 7189; // GAMECODE KENYA
//$subpdtid = 6205; // your product ID
//$subpdtid = 800;	//QUICKTELLER
$submittedamt = $_POST["amount"];
$submittedref = $_POST["txnref"];
$userid = $_SESSION["userid"];
$response = $_POST["resp"];
$payrefernce = $_POST["payRef"];
$returnedreference = $_POST["retRef"];
$description = $_POST["desc"];
$convertedamount = $submittedamt/100;

if($response == "00"){
    echo '<div class="alert alert-danger"><strong>Great!</strong> <a href="javascript:void(0);" class="alert-link">Your Transaction was successfull</a> and your wallet has been funded.</div>';
}


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

$sql = "INSERT INTO tblpayments (User_Id, Transaction_Id, Amount, responseType, payReference, returnedReference, description)
VALUES ('$userid', '$submittedref', '$convertedamount','$response','$payrefernce','$returnedreference','$description')";

if($response == "00"){
$query = "UPDATE tblwallet SET balance = balance + $convertedamount WHERE user_id = $userid ";
$insert_v = mysqli_query($conn,$query);

$sql1 = "INSERT into tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$userid','Wallet Funding','credit','$convertedamount')";
$res1 = mysqli_query($conn,$sql1);
}else{}

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>