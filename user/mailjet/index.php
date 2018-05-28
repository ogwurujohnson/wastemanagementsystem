<?php
require 'vendor/autoload.php';
use \Mailjet\Resources;


// or

$apikey = 'e74b65d9de2bebba3c510e21a46b645e';
$apisecret = 'b7eaf3445256dea3396f11a82afd621f';

$mj = new \Mailjet\Client($apikey, $apisecret);
$body = [
    'FromEmail' => "info@gafistaconcepts.com",
    'FromName' => "Gafista Concepts",
    'Subject' => "Verifying Transaction",
    'MJ-TemplateID' => 403151,
    'MJ-TemplateLanguage' => true,
    'Vars' => json_decode('{
        "firstname": "john",
        "amount": "5000",
        "pay_ref": "933033292",
        "transaction_id": "JB939303"
      }', true),
    'Text-part' => "Dear Johnson, welcome to Mailjet! May the delivery force be with you!",
    'Html-part' => "<h3>Dear passenger, welcome to Mailjet!</h3><br />May the delivery force be with you!",
    'Recipients' => [
        [
            'Email' => "ogwurujohnson@gmail.com"
        ]
        
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && var_dump($response->getData());
?>