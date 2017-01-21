<?php
$access_token = 'tE5TtVey741f7fDa2y1u9+NYbfhdbqRItsIE2vnbPW2uWusExRsQwnuuRX1+CVvtPCP+vwnPPgZ3wKrmIYKGHRn4QcqAlySw1879KZOHLfoVvid/E5BNsT+f0ptGwzMGvBcA3CHjyv3hoxK0TXyQAAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
