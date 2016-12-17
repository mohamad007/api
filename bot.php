<?php
ob_start();
define('API_KEY','290575108:AAGXkVKHlVcxw3MovveXtgnNetR0nwoewiY');
$admin =  "193930120";
$update = json_decode(file_get_contents('php://input'));
$from_id = $update->message->from->id;
$chat_id = $update->message->chat->id;
$text = $update->message->text;
function roonx($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
if{$txt = urlencode($text);
$time = file_get_contents("https://irapi.ir/simsimi/api2.php?text=$txt&lang=fa");
roonx('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>$time,
    'parse_mode'=>'html'
  ]);
}
	?>
