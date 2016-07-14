
file_put_contents("fb.txt",file_get_contents("php://input"));
  $fb = file_get_contents("fb.txt");
  $fb = json_decode($fb);
  //$rid is the recipient id and here we are getting the sender id from the message json body
$rid = $fb->entry[0]->messaging[0]->sender->id;
$Token = "EAARFZAgZCvAmcBAHCScZAY75ob3gHlpKAwGRizbBj5xmhLEwqep1lNVtrb7n6j53XjbyKwxT79Mypvt0LjlWjI0TfhQIJ2QnqrM9eRfABNybxQOZB6ZB9ZCTCVeDzdhScfLlxDC3qgX2rysyc4WofIADAPIAsWub3hnWS3X93fngZDZD";

$data = array(
    'recipient' => array('id'=>"$rid"),
    'message' => array('text'=>"Nice to meet you")
    );

$options = array(
    'http'=> array(
        'method'  => 'POST',
        'content' => json_encode($data),
        'header'  => "Content-Type: application/json\n"
        )
    
    );
$context = stream_context_create($options);
file_get_contents("https://graph.facebook.com/app?access_token=$Token", false ,$context);
