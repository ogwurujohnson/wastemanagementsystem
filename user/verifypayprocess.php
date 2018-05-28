<?php

require 'mailjet/vendor/autoload.php';
use \Mailjet\Resources;

$amount = $_GET['amount'];
$txnref = $_GET['merchId'];
$responseType = $_GET['responseType'];
$payRef = $_GET['payRef'];
$returnedRef = $_GET['returnedRef'];
$description = $_GET['desc'];
$convertedamount = $amount/100;
$finalamount = $convertedamount-100;
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
                $query = "UPDATE tblwallet SET balance = balance + $finalamount WHERE user_id = $userid ";
                $insert_v = mysqli_query($conn,$query);
                
                $sql1 = "INSERT into tblcreditdebit (user_id,transaction_description,transaction_type,amount) VALUES ('$userid','Wallet Funding','credit','$convertedamount')";
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
                header("Location: https://localhost/gafista/user/uvwallet.php");
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
?>