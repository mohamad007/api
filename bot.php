<?php
define('API_KEY','322735835:AAFCgc68IVTEaqm69Xln9ywHojz2UYVEovA');
//token
function makereq($method,$datas=[]){
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
//mrphp
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$textmessage = isset($update->message->text)?$update->message->text:'';
$rpto = $update->message->reply_to_message->forward_from->id;
$forward = $update->message->forward_from;
$txtmsg = $update->message->text;
$Dev = 193930120;
//mrphp
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
//mrphp
$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@MrPhPTeam&user_id=".$from_id);
	if (strpos($inch , '"status":"left"') !== false ) {
SendMessage($chat_id,"سلام $name 
براي استفاده از ربات باید در کانال زیر عضوبشی :
@MrPhPTeam");
}
if($textmessage == '/start')
  if ($from_id == $Dev) {
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام بابایی\n`خوش امدید به ربات",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                 ['text'=>"بکاپ گیری"],['text'=>"ارسال پیام به همه"]
              ],
	              [
                 ['text'=>"آمار"],['text'=>"بخش مدیریت کاربران"]
              ],
	              [
	               ['text'=>"راهنما"]
	            ]
                       
            ],
           	'resize_keyboard'=>true
        ])
    ]));
 
 else{

var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام $name \n\nخوش اومدی به ربات آقای پی اچ پی ",
        'parse_mode'=>'MarkDown',
          	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                   ['text'=>"درباره ما"],['text'=>"امکانات"]
                ],
                  [
                   ['text'=>"قوانین"],['text'=>"ارسال نظر"]
                ]
                
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}   
elseif ($textmessage == 'درباره ما') {
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"<code>تیم ربات سازی اقای پی اچ پی در سال 95-96 کار خودرا در زمینه ساخت ربات تلگرام (ای پی ای )شروع کرد ودر این زمینه تا به الان موفق بوده است.
كانال ما : @MrPhPTeam
برنامه نويس : @MrPhPSupport
این ربات توسط زبان برنامه نویسی پی اچ پی کدنویسی شده است.</code>
",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [
                    ['text'=>"رفتن به کانال",'url'=>"https://telegram.me/MrPhPTeam"],
                    ['text'=>"توسعه دهنده",'url'=>"https://telegram.me/MrPhPSupprt"]
                ]
            ]
        ])
    ]));
}
elseif ($textmessage == 'بخش مدیریت کاربران') 
       if ($from_id == $Dev) {
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"به بخش مدیریت کاربران خوش آمدید",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
          	'keyboard'=>[
                [
                   ['text'=>"بخش بن"],['text'=>"پاک کردن لیست بلاک شده ها"]
                ],
                  [
                   ['text'=>"بازگشت به منوی اصلی"]
                ]
                
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}   
elseif ($textmessage == 'بازگشت به منوی اصلی') 
       if ($from_id == $Dev) {
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"برگشتیم",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                 ['text'=>"بکاپ گیری"],['text'=>"ارسال پیام به همه"]
              ],
	              [
                 ['text'=>"آمار"],['text'=>"بخش مدیریت کاربران"]
              ],
	              [
	               ['text'=>"راهنما"]
	            ]
                       
            ],
           	'resize_keyboard'=>true
        ])
    ]));
}    
elseif ($textmessage == 'بازگشت به منوی اصلی') {
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"برگشتیم",
	'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                 ['text'=>"درباره ما"],['text'=>"امکانات"]
             ],
               [
                   ['text'=>"قوانین"],['text'=>"ارسال نظر"]
             ]
                
            	],
            	'resize_keyboard'=>true
       		])
    		]));
} 
elseif ($textmessage == 'ارسال نظر') {
var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"
					`برای ارسال نظر خود از دستور زیر استفاده کنید`
					*/feedback text*
					",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'resize_keyboard'=>true
       		])
    		]));
}
elseif($textmessage == '/feedback') {
$text = str_replace("/feedback","",$textmessage);
SendMessage($chat_id,"نظر شما برای ادمین فرستاده شد!");
SendMessage($admin,"FeedBack:\n name: $name \n Username: @$username \n id: $from_id\n`Text: \n$text`");
}
}
elseif (strpos($textmessage , "بن" ) !== false ) {
if ($from_id == $Dev) {
$text = str_replace("بن","",$textmessage);
$fp = fopen( "users.txt", 'r');
{
if (!file_exists("$from_id/step.txt")) {
$myfile2 = fopen("banlist.txt", "a") or die("Unable to open file!");	
fwrite($myfile2, "$text\n");
fclose($myfile2);
}
while( !feof( $fp)) {
 $users = fgets( $fp);
SendMessage($admin,"شما کاربر $text را در لیست بن لیست قرار دادید!\n برای در اوردن این کاربر از بن از دستور زیر استفاده کنید\n/ان بن");
}
}
}
else {
SendMessage($chat_id,"⛔️ شما ادمین نیستید.");
}
}
  ?>
