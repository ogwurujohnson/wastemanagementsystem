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

$sql = "UPDATE tblpayments SET status = '1', responseType = '$response', payReference = '$payrefernce', returnedReference = '$returnedreference', description = '$description' WHERE User_Id = '$userid' && status = '0' && Transaction_Id = '$submittedref' ";

if($response == "00" && $conn->query($sql) === TRUE){
$query = "UPDATE tblwallet SET balance = balance + $convertedamount WHERE user_id = $userid ";
$insert_v = mysqli_query($conn,$query);

$sql1 = "INSERT into tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$userid','Wallet Funding','credit','$convertedamount')";
$res1 = mysqli_query($conn,$sql1);
}else{}

if ($conn->query($sql) === TRUE) {
    header("Location: https://localhost/gafista/user/uvwallet.php?response=$response&&submittedref=$submittedref ");
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>