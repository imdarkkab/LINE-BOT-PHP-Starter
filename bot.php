<?php
$access_token = 'cYmojL4PjzpRhwAAgAN6a367PA47vJ4akD8uoDnrHsY/bm1Su+fEroz586WX9MZiYjFvdw5JzQYrFOmQ/xdxYRtbRDHiyzN3ULH87FQHqDOkzKeIEUzue1DRMBXVNQ4EelQ2D2ecvDXyz00bRP3ragdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;