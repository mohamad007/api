<?php
define('API_KEY','322735835:AAF65PDyiv8ICeMtbUYB21CE9zM0SSMXrh8');
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
if($textmessage == '/start')
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
  ?>
