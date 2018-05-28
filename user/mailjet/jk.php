<?php
  /*
  This call sends a message to the given recipient with vars and custom vars.
  */
  require 'vendor/autoload.php';
  use \Mailjet\Resources;
  $mj = new \Mailjet\Client('e74b65d9de2bebba3c510e21a46b645e', 'b7eaf3445256dea3396f11a82afd621f',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "ogwurujohnson.com",
          'Name' => "Gafista Concepts Limited"
        ],
        'To' => [
          [
            'Email' => "passenger1@example.com",
            'Name' => "passenger 1"
          ]
        ],
        'TemplateID' => 403151,
        'TemplateLanguage' => true,
        'Subject' => "Transaction Update",
        'Variables' => json_decode('{
    "firstname": "Default value",
    "total_price": "Default value",
    "order_date": "Default value",
    "order_id": "Default value"
  }', true)
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());
?>