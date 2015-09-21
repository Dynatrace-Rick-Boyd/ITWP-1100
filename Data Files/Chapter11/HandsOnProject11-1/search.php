<?php

/****

* Simple PHP application for using the Bing Search API

*/

$acctKey = 'accountkey';

$rootUri = 'https://api.datamarket.azure.com/Bing/Search';

// Encode the query and the single quotes that must surround it.

$query = urlencode("'{$_GET['q']}'");

// Get the selected service operation (Web or Image).

$serviceOp = "Web";

// Construct the full URI for the query.

$requestUri = "$rootUri/$serviceOp?\$format=json&Query=$query"; 

// Encode the credentials and create the stream context.

$auth = base64_encode("$acctKey:$acctKey");

$data = array(

'http' => array(

'request_fulluri' => true,

// ignore_errors can help debug – remove for production. This option added in PHP 5.2.10

'ignore_errors' => true,

'header' => "Authorization: Basic $auth")

);

$context = stream_context_create($data);

// Get the response from Bing.

$response = file_get_contents($requestUri, 0, $context); 

header("Content-Type: text/json");

echo $response;

?> 