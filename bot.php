<?php
$access_token = 'cYmojL4PjzpRhwAAgAN6a367PA47vJ4akD8uoDnrHsY/bm1Su+fEroz586WX9MZiYjFvdw5JzQYrFOmQ/xdxYRtbRDHiyzN3ULH87FQHqDOkzKeIEUzue1DRMBXVNQ4EelQ2D2ecvDXyz00bRP3ragdB04t89/1O/w1cDnyilFU=';


//$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
//$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'f863004efd0def573f18cb624501918a']);


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

$reply_messages = array(
"เหี้ย","ห่า","สัด","ควย",
"หี","หำ","หัม","กระดอ",
"จิ๋ม","จู๋","เจี๊ยว","พ่อมึงตาย",
"แม่มึงตาย","เย็ด","กู","มึง",
"ดอกทอง","ควาย","กะหรี่",
"แมงดา","หน้าตัวเมีย","สถุน",
"สวะ","ส้นตีน","หมอย","ร่าน",
"เงี่ยน","ไพร่","สลัม","ถ่อย","ตอแหล","เสือก","หน้าด้าน","แม่ง","แตด","ไอ้","ชิบหาย"
);
//$random_keys=array_rand($reply_messages,count($reply_messages));

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {

        //$response = $bot->replyText($event['replyToken'], $reply_messages[array_rand($reply_messages)]);
        
		if ($response->isSucceeded()) {
			echo 'Succeeded!';
			return;
		}

		// Failed
		echo $response->getHTTPStatus . ' ' . $response->getRawBody();

		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => /*$text*/ $reply_messages[array_rand($reply_messages)]
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";