<?php

require_once('../vendor/autoload.php');
use Officialmeritinfos\NextropayPhp\NextropayAPI;

$pubKey = 'CBX_PUB_16464360112130893623';
$secKey = 'CBX_SEC_1646436011210565308';
$env = 'TEST';


$client = new NextropayAPI($pubKey,$env);
$response = $client->GetBusiness();
// $responses = json_decode($response->getBody(),1);
// print_r($responses);