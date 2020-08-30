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

if($message=='Hello!NEO KMS!'){
    $reply_message='{
        "messaging_type": "RESPONSE",
        "recipient": {
          "id": "3244230802322471"
        },
        "message": {
          "text": "Yes there. 1.If you want to know about available Program type PROGRAM 2.If you want yo know about schedule type SCHEDULE "
        }
      }' ;

      send_reply($access_token,$reply_message);
    
}
if($message=='PROGRAM'){
    $reply_message='{
        "messaging_type": "RESPONSE",
        "recipient": {
          "id": "3244230802322471"
        },
        "message": {
          "text": "There are 14 new program.For details contact #Phone number-1234567"
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
