<?php
ob_start();
define('API_KEY','290575108:AAH0fw475xE4WZ9SphyVOPZkGVp6vr1j1YQ');
$admin =  "193930120";
$update = json_decode(file_get_contents('php://input'));
$from_id = $update->message->from->id;
$chat_id = $update->message->chat->id;
$text = $update->message->text;
$time = file_get_contents("http://roonx.com/api.php?roonx=time");
$date = file_get_contents("http://roonx.com/api.php?roonx=date");
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
if(preg_match('/^\/([Ss]tart)/',$text)){
roonx('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"سلام به ربات تاریخ و زمان خوش اومدی:)
	دستور زیر رو برای دیدن زمان وتارخ بفرستید
	/td",
    'parse_mode'=>'html'
  ]);
}elseif(preg_match('/^\(.*)/s',$text)){
  preg_match('/^\(.*)/s',$mtch,$text);
    $txt = urlencode($mtch[1]);
    $time = file_get_contents('https://irapi.ir/simsimi/api2.php?text='.$txt&lang=fa);
roonx('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>$time,
    'parse_mode'=>'html'
  ]);
}elseif(preg_match('/^\/([Ss]tats)/',$text) and $from_id == $admin){
    $user = file_get_contents('Member.txt');
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
    roonx('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"تعداد کل اعضا: $member_count",
      'parse_mode'=>'HTML'
    ]);
}
$user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('Member.txt',$add_user); 
    }
	?>
