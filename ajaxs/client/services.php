<?php
header('Content-Type: application/json');

$url = 'https://api.usotp.xyz/services?apikey=sHn22XhtF60glXhyPWiMB425UrTh0xMn';

$response = file_get_contents($url);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(["error" => "Unable to fetch data"]);
} else {
    echo $response;
}
