<?php

$payload = [
    "code"   => "ugurmuslim21",
    "action" => "transfer",
    "args"   => [
        "from"     => "ugurmuslim21",
        "to"       => "cemsinacetin",
        "quantity" => "1.0000 GLMTEST",
        "memo"     => "KEEEYYY ",
    ],
];
$payload = json_encode($payload);
// Prepare new cURL resource
$ch = curl_init('http://jungle2.cryptolions.io:80/v1/chain/abi_json_to_bin');
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

$binArgs = $result['binargs'];
// Close cURL session handle
curl_close($ch);

////////////////////////////////////////////////


$payload = [
    "code"   => "ugurmuslim21",
    "action" => "transfer",
    "args"   => [
        "from"     => "ugurmuslim21",
        "to"       => "cemsinacetin",
        "quantity" => "1.0000 GLMTEST",
        "memo"     => "KEEEYYY",
    ],
];
$payload = json_encode($payload);
// Prepare new cURL resource
$ch = curl_init('http://127.0.0.1:8090/v1/wallet/get_public_keys');
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
$public_keys = $result;
curl_close($ch);
var_dump($public_keys);
////////////////////////////////////////////////////


// create curl resource

$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://jungle2.cryptolions.io:80/v1/chain/get_info");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources

curl_setopt($ch, CURLOPT_URL, "");

curl_close($ch);

$output = json_decode($output, true);
$chainID = $output['chain_id'];
$payload = [
    'block_num_or_id' => $output['head_block_num'],
];
$payload = json_encode($payload);

// Prepare new cURL resource
$ch = curl_init('http://jungle2.cryptolions.io:80/v1/chain/get_block');
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
$blockNum = $result['block_num'];
$blockPrefix = $result['ref_block_prefix'];
// Close cURL session handle
curl_close($ch);

/////////////////////////////////////7

    $payload = [ "default", "PW5Kbk6BSMRKq9ZRzc2QWtrtoTFgAfDgwkactPBRiZePaXNriLzkD" ];
$payload = json_encode($payload);
// Prepare new cURL resource
$ch = curl_init('http://jungle2.cryptolions.io:80/v1/wallet/unlock');
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
// Close cURL session handle
curl_close($ch);


$date = date("c", strtotime("-2 hours"));
$date = str_replace('+03:00', '.000', $date);
$payload = [
    "transaction"    => [
        "expiration"             => $date,
        "ref_block_num"          => $blockNum,
        "ref_block_prefix"       => $blockPrefix,
        "max_net_usage_words"    => 0,
        "max_cpu_usage_ms"       => 0,
        "delay_sec"              => 0,
        "context_free_actions"   => [],
        "actions"                => [ [
                                          "account"       => "ugurmuslim21",
                                          "name"          => "transfer",
                                          "authorization" => [ [
                                                                   "actor"      => "ugurmuslim21",
                                                                   "permission" => "active",
                                                               ],
                                          ],
                                          "data"          => $binArgs,
                                      ],
        ],
        "transaction_extensions" => [],
    ],
    "available_keys" => $public_keys,
];

$payload = json_encode($payload);


// Prepare new cURL resource
$ch = curl_init('http://jungle2.cryptolions.io:80/v1/chain/get_required_keys');
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
$requiredKey = $result['required_keys'][0];
// Close cURL session handle
curl_close($ch);


$payload =
    [
        [
            "ref_block_num"    => $blockNum,
            "ref_block_prefix" => $blockPrefix,
            "expiration"       => $date,
            "actions"          => [
                [
                    "account"       => "ugurmuslim21",
                    "name"          => "transfer",
                    "authorization" => [
                        [
                            "actor"      => "ugurmuslim21",
                            "permission" => "active",
                        ],
                    ],
                    "data"          => $binArgs,
                ],
            ],
            "signatures"       => [],
        ],
        [
            $requiredKey,
        ],
        $chainID,
    ];


$payload = json_encode($payload);

// Prepare new cURL resource
$ch = curl_init('http://127.0.0.1:8090/v1/wallet/sign_transaction');
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
$signature = $result['signatures'][0];
// Close cURL session handle
curl_close($ch);


$payload = [

    "compression" => "none",
    "transaction" => [
        "expiration"             => $date,
        "ref_block_num"          => $blockNum,
        "ref_block_prefix"       => $blockPrefix,
        "context_free_actions"   => [],
        "actions"                => [
            [
                "account"       => "ugurmuslim21",
                "name"          => "transfer",
                "authorization" => [
                    [
                        "actor"      => "ugurmuslim21",
                        "permission" => "active",
                    ],
                ],
                "data"          => $binArgs,
            ],
        ],
        "transaction_extensions" => [],
    ],
    "signatures"  => [
        $signature,
    ],
];

$payload = json_encode($payload);


// Prepare new cURL resource
$ch = curl_init('http://jungle2.cryptolions.io:80/v1/chain/push_transaction');
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
// Close cURL session handle
curl_close($ch);
var_dump($result);

//////////////////////////////




?>
