<?php

require_once('../vendor/autoload.php');
use Officialmeritinfos\NextropayPhp\NextropayAPI;

$pubKey = '';
$secKey = '';
$env = 'TEST';

$data=[
    "name"=>"Meritinfos Testnet",
    "description"=>"Buxiscrow is you gateway to secured financial transaction",
    "businessType"=>"1",
    "trustedIps"=>"",
    "pin"=>"472988",
    "whoPay"=>"2"
];

$client = new NextropayAPI($pubKey,$env);
$response = $client->UpdateBusiness($data);
echo $response;