<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['OPENAI_API_KEY'];
$endpoint = 'https://api.openai.com/v1/engines/davinci/completions';

$input = 'Once upon a time';
$data = [
    'prompt' => $input,
    'max_tokens' => 50,
];

$client = new \GuzzleHttp\Client();
$response = $client->post($endpoint, [
    'headers' => [
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ],
    'json' => $data,
]);

if ($response->getStatusCode() === 200) {
    $responseData = json_decode($response->getBody(), true);
    $generatedText = $responseData['choices'][0]['text'];
    echo $generatedText;
} else {
    echo 'Error: ' . $response->getStatusCode();
}
