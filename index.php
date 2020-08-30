<?php
$my_verify_token = "1234567SUMU";

    $challenge = $_GET['hub_challenge'];
    $verify_token = $_GET['hub_verify_token'];



if ($my_verify_token === $verify_token) {
    echo $challenge;
    exit;
}

$access_token='EAAKwqx4lEv4BAByHegq4zZCEUt12jTPXo91A2tA4wcdSUW19i0Q8pREvxAy6XEV9LqkMFHkj8brNDjafNtYZBRyMhB4OlCV20KdQ7gfy5L7aBSyNKWbyhIUpBH3TBpsiVjw8RKpxG1t6Li9zlRjOktlaVcpbOrYQZAropPP426ImzYj1YNRG0wVrommGCUZD';

$response=file_get_contents("php://input");
$response=json_decode($response,true);

$message=$response['entry'][0]['messaging'][0]['message']['text'];

if($message=='hello'){
    $reply_message='{
        "messaging_type": "RESPONSE",
        "recipient": {
          "id": "3443583338995846"
        },
        "message": {
          "text": "hello, Do you need any Information"
        }
      }' ;

      send_reply($access_token,$reply_message);
    
}
if($message=='hi'){
    $reply_message='{
        "messaging_type": "RESPONSE",
        "recipient": {
          "id": "3443583338995846"
        },
        "message": {
          "text": "Please ask your query!"
        }
      }' ;

      send_reply($access_token,$reply_message);
    
}


   function send_reply($access_token='',$reply='')
  {
      $url="https://graph.facebook.com/v8.0/me/messages?access_token=$access_token";
      $ch=curl_init();
      $headers=array("Content-type: application/json");
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $reply);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $st=curl_exec($ch);
      $result=json_decode($st,TRUE);
      return $result;

  }



?>