
<?php
// parameters
$hubVerifyToken = 'abc*123';
$accessToken = "EAARFZAgZCvAmcBAO4h5yJIptGW2MXZB5CJdJtVaQyXWmwcKClJpjVx5apkzZCZCmPCFQosfxElZAjWFTExAkDsrjvLDZAFv9ZCGNfDWUsEO7gClZAXtoBg9oAedb8iYoZA6ZC9c5x2sFkA4xG7qGfFOJK1lv9fmsHaXrY71ZCylYqjU3sQZDZD";

// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  print_r($_REQUEST['hub_challenge']);
 print_r($_GET["hub_challenge"]);
  exit;
  
}

// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);

$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];



if($messageText == "hi") {
    $answer = "Hello";
}
else {
    $answer = "I don't understand. Ask me 'hi'.";
}
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);

  ?>