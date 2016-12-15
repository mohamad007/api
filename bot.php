<?php 
$token = '276874700:AAFWzQdCIuXY8GzaSEgxa8M8QdkMltwsxwk';
// read incoming info and grab the chatID 
$json = file_get_contents('php://input');
$telegram = urldecode ($json);
$telegram = str_replace ('jason=','',$telegram); //Just for Teletter.net
$results = json_decode($telegram); 



		
// send reply
 // $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id=80853440&text='.$json;
 // file_get_contents($url);








$message = $results->message;
$text = $message->text;
$chat = $message->chat;
$user_id = $chat->id;

// if ($text == 'salam') {
	// $message = 'سلام';
// } else if ($text == 'چطوری') {
	// $message = 'خوبم';
// } else {
	// $message = 'نمیدونم';
// }

// // send reply
// $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message.'&reply_to_message_id=224';
// file_get_contents($url);






$message = 'websima Academy';
$message = urldecode($message);
// websima_sendmessage ($user_id,$message,$token);
// //Send Text Message 
// function websima_sendmessage ($user_id,$message,$token) {
	// $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message;
	// $update = file_get_contents($url);
// }








// $keyboard = array(
					// array( 'ورود به سایت'),
					// array( 'amin'),
					// array ('وبسیما','آکادمی','test'),
				// );

// $keyboard = array(
					// array( array('text'=>'شماره تماس','request_contact'=>true)),
				// );
// websima_keyboardmessage ($user_id,$message,$token,$keyboard);

// //Send Text Message With Inline Keyboard
// function websima_keyboardmessage ($user_id,$message,$token,$keyboard) {
	// $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
	// $replyMarkup = array(
				// 'keyboard' => $keyboard,
				// 'resize_keyboard' => true
			// );
	// $encodedMarkup = json_encode($replyMarkup);
	// $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message.'&reply_markup='.$encodedMarkup;
	// $update = file_get_contents($url);
// }


// $keyboard = array(
					// array( 'ورود به سایت'),
					// array ('وبسیما','آکادمی'),
				// );

$keyboard = array(
					array( 
					array('text'=>'شماره تماس','url'=>'http://websima.com'),
					array('text'=>'اطلاعات','callback_data'=>'1')
					),
				);
websima_inlinekeyboardmessage ($user_id,$message,$token,$keyboard);

//Send Text Message With Inline Keyboard
function websima_inlinekeyboardmessage ($user_id,$message,$token,$keyboard) {
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
	$replyMarkup = array(
				'inline_keyboard' => $keyboard
			);
	$encodedMarkup = json_encode($replyMarkup);
	$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id.'&text='.$message.'&reply_markup='.$encodedMarkup;
	$update = file_get_contents($url);
}






?>
