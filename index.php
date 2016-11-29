<?php

define('API_KEY','209348445:AAE0cUDH26poodD_CAx81PMEtYgkfV-m3wc');
//----######------
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//##############=--API_REQ
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}
//----######------
//---------
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$boolean = file_get_contents('booleans.txt');
  $booleans= explode("\n",$boolean);

$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$textmessage = isset($update->message->text)?$update->message->text:'';
$rpto = $update->message->reply_to_message->forward_from->id;
$stickerid = $update->message->reply_to_message->sticker->file_id;
$photo = $update->message->photo;
$video = $update->message->video;
$sticker = $update->message->sticker;
$file = $update->message->document;
$music = $update->message->audio;
$voice = $update->message->voice;
$forward = $update->message->forward_from;
$admin = 193930120;
//-------
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendSticker($ChatId, $sticker_ID)
{
 makereq('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
makereq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}

//------------

if($textmessage == '/start')
 if ($from_id == $admin) {
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"hi admin",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"stats"],['text'=>"sendtoall"]
              ],
	      [
	        ['text'=>"help"]
	      ]
            ]
        ])
    ]));
 }
 else{
 
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام `$name` \n\nاز دکمه های زیر استفاده کن",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"TeleBlaster Project"],['text'=>"List Members",]
              ],
	      [
                ['text'=>"List Bots"],['text'=>"FeedBack"]
              ]
            ]
        ])
    ]));	
    $txxt = file_get_contents('member.txt');
$pmembersid= explode("\n",$txxt);
	if (!in_array($chat_id,$pmembersid)) {
		$aaddd = file_get_contents('member.txt');
		$aaddd .= $chat_id."
";
    	file_put_contents('member.txt',$aaddd);
}
 }
 
if($textmessage == 'List Members')
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"یکی از دکمه های زیر رو انتخاب کن",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"mohamadhossein"],['text'=>"parsa"]
              ],
	      [
	        ['text'=>"back"]
	      ]
            ]
        ])
    ]));
 
if($textmessage == 'back')
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"برگشتیم",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
           [
                ['text'=>"TeleBlaster Project"],['text'=>"List Members",]
              ],
	      [
                ['text'=>"List Bots"],['text'=>"FeedBack"]
              ]
            ]
        ])
    ]));
     
 
if($textmessage == 'List Bots')
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"یکی از دکمه های زیر رو انتخاب کن",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"TeleBlaster"],['text'=>"TeleBlasterBot"]
              ],
	      [
	        ['text'=>"back"]
	      ]
            ]
        ])
    ]));
  
elseif($textmessage == 'TeleBlasterBot')
  {
  	Sendmessage($chat_id,"خالی");
  }  
elseif($textmessage == 'TeleBlaster')
  {
  	Sendmessage($chat_id,"خالی");
  }  
elseif($textmessage == 'mohamadhossein')
  {
  	Sendmessage($chat_id,"خالی");
  }
elseif($textmessage == 'parsa')
  {
  	Sendmessage($chat_id,"خالی");
  }  
elseif($textmessage == 'TeleBlaster Project')
  {
  	Sendmessage($chat_id,"خالی");
  }
 
elseif($textmessage == 'FeedBack')
  {
  	Sendmessage($chat_id,"به زودی");
  }  

elseif($textmessage == 'help')
if($chat_id == $admin){
	{
		Sendmessage($chat_id,"stats : نماش تعداد کاربران
   
    sendtoall : ارسال کردن پیام به تمام کاربران ربات");
	}
}
 
	elseif($textmessage == 'stats' && $chat_id == $admin)
	{
		$txtt = file_get_contents('member.txt');
		$membersidd= explode("\n",$txtt);
		$mmemcount = count($membersidd) -1;
{
sendmessage($chat_id,"تعداد کاربران ربات : $mmemcount");
}
}
        elseif ($textmessage =="sendtoall"  && $chat_id == $admin | $booleans[0]=="false") {
	{
          sendmessage($chat_id,"لطفا پیام خودرا ارسال کنید");
	}
      $boolean = file_get_contents('booleans.txt');
		  $booleans= explode("\n",$boolean);
	  	$addd = file_get_contents('banlist.txt');
	  	$addd = "true";
    	file_put_contents('booleans.txt',$addd);

    }
      elseif($chat_id == $admin && $booleans[0] == "true") {
    $texttoall = $textmessage;
		$ttxtt = file_get_contents('member.txt');
		$membersidd= explode("\n",$ttxtt);
		for($y=0;$y<count($membersidd);$y++){
			sendmessage($membersidd[$y],"$texttoall");

		}
		$memcout = count($membersidd)-1;
	 	{
	 	Sendmessage($chat_id,"پیغام شما به $memcout مخاطب ارسال شد.");
	 	}
         $addd = "false";
    	file_put_contents('booleans.txt',$addd);
    	}
?>
