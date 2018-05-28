<?php


require '../mailjet/vendor/autoload.php';
use \Mailjet\Resources;

session_start();



$subpdtid = 1076; // SANDBOX
//$subpdtid = 7189; // GAMECODE KENYA
//$subpdtid = 6205; // your product ID
//$subpdtid = 800;	//QUICKTELLER
$submittedamt = $_POST["amount"];

$submittedref = $_POST["txnref"];
$userid = $_SESSION["userid"];
$useremail = $_SESSION["useremail"];
$txnresponse = $_POST["resp"];
$payrefernce = $_POST["payRef"];
$returnedreference = $_POST["retRef"];
$description = $_POST["desc"];
$convertedamount = $submittedamt/100;
$finalamount = $convertedamount-100;




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

$sql = "UPDATE tblpayments SET status = '1', responseType = '$txnresponse', payReference = '$payrefernce', returnedReference = '$returnedreference', description = '$description' WHERE User_Id = '$userid' && status = '0' && Transaction_Id = '$submittedref' ";

if($txnresponse == "00" && $conn->query($sql) === TRUE){
$query = "UPDATE tblwallet SET balance = balance + $finalamount WHERE user_id = $userid ";
$insert_v = mysqli_query($conn,$query);

//insert into tblcredit to keep track of table and also send a succesful mail
$sql1 = "INSERT into tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$userid','Wallet Funding','credit','$finalamount')";
$res1 = mysqli_query($conn,$sql1);
$apikey = 'e74b65d9de2bebba3c510e21a46b645e';
$apisecret = 'b7eaf3445256dea3396f11a82afd621f';

    $mj = new \Mailjet\Client($apikey, $apisecret);
    $body = [
        'FromEmail' => "info@gafistaconcepts.com",
        'FromName' => "Gafista Concepts",
        'Subject' => "Verifying Transaction",
        /*'MJ-TemplateID' => 403151,
        'MJ-TemplateLanguage' => true,
        'Vars' => json_decode('{
            "firstname": "john",
            "amount": "$convertedamount",
            "description": "$description",
            "transaction_id": "$submittedref"
        }', true),*/
        'Text-part' => "Dear $firstname, welcome to Mailjet! May the delivery force be with you!",
        'Html-part' => "<h3>Goodday, </h3><br />Your transaction of $convertedamount was successful <br/> Your Transaction Reference: $submittedref",
        'Recipients' => [
            [
                'Email' => $useremail
            ]
            
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success() && var_dump($response->getData());
}else{
    $apikey = 'e74b65d9de2bebba3c510e21a46b645e';
$apisecret = 'b7eaf3445256dea3396f11a82afd621f';

    $mj = new \Mailjet\Client($apikey, $apisecret);
    $body = [
        'FromEmail' => "info@gafistaconcepts.com",
        'FromName' => "Gafista Concepts",
        'Subject' => "Verifying Transaction",
        /*'MJ-TemplateID' => 403151,
        'MJ-TemplateLanguage' => true,
        'Vars' => json_decode('{
            "firstname": "john",
            "amount": "$convertedamount",
            "description": "$description",
            "transaction_id": "$submittedref"
        }', true),*/
        'Text-part' => "Dear $firstname, welcome to Mailjet! May the delivery force be with you!",
        'Html-part' => "<h3>Goodday, </h3><br />Your payment of $convertedamount to Gafista for wallet funding was not successful! <br/> Your Transaction Reference: $submittedref",
        'Recipients' => [
            [
                'Email' => $useremail
            ]
            
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success() && var_dump($response->getData());
}

if ($conn->query($sql) === TRUE) {
    header("Location: https://localhost/gafista/user/uvwallet.php?response=$txnresponse&&submittedref=$submittedref ");
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();




?>