<?php
/**
 * Created by PhpStorm.
 * User: ugur - Bilal ATLI
 * Date: 1.02.2020
 * Time: 23:58
 * E-mail : <bilal@garivaldi.com>, <ytbilalatli@gmail.com>
 * Phone : +90 0-542-433-09-19
 * Original Filename : history.php
 */

$payload = [
    "account_name" => "ugurmuslim12",
    "pos"          => -1,
    "offset"       => -40,

];

$payload = json_encode($payload);


// Prepare new cURL resource
$ch = curl_init('https://eos.greymass.com/v1/history/get_actions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set HTTP Header for POST request
curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload) ]
);

// Submit the POST request
$result = curl_exec($ch);
$result = json_decode($result, true);

foreach($result as  $r => $e) {
    foreach ($e as $b) {
        var_dump($b['action_trace']['act']['data']['memo']);
    }
}


// Close cURL session handle
curl_close($ch);
