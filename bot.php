<?php
require_once("temp_file.php");

$access_token = 'tE5TtVey741f7fDa2y1u9+NYbfhdbqRItsIE2vnbPW2uWusExRsQwnuuRX1+CVvtPCP+vwnPPgZ3wKrmIYKGHRn4QcqAlySw1879KZOHLfoVvid/E5BNsT+f0ptGwzMGvBcA3CHjyv3hoxK0TXyQAAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			$link = "http://api.openweathermap.org/data/2.5/forecast/weather?q=".
				$text
				.",th&APPID=a66d4a763bdf2b109ee7c0b91796a3c9";
			// Build message to reply back
			$s = avg($link);
			$str = "เมือง ".$obj['city']['name']."􀂲".
			" อุณหภูมิสูงสุด (temperature_max) : ".round(($s['max']-273.15),2). //show temp max
			"℃ อุณหภูมิต่ำสุด (temperature_min) : ".round(($s['min']-273.15),2). // show temp min
			"℃ อุณหภูมิเฉลี่ย (temperature_avg) : ".round(($s['mid']-273.15),2)."℃";
			$messages = [
				'type' => 'text',
				'text' => $str
			];
			
			
			$img = [
			    "type"=> "image",
			    "originalContentUrl"=>"https://raw.githubusercontent.com/kittinan/Sample-Line-Bot/master/images/beer.jpg",
			    "previewImageUrl"=>"https://raw.githubusercontent.com/kittinan/Sample-Line-Bot/master/images/beer_preview.jpg"
			];
			
			

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages,$img],
			];
			
			$post = json_encode($data);
			echo $messages;
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
