<?php
$url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=200010";
$json = file_get_contents($url);
$obj = json_decode($json, true);
var_dump($obj);
?>