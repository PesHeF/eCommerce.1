<?php
// chatbot.php

// Get the user input from the frontend
$inputData = json_decode(file_get_contents("php://input"), true);

// Check if user input is valid
if (!$inputData || !isset($inputData['user_input'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}

$userInput = $inputData['user_input'];

// OpenAI API Key (use a secure way to store the API key)
$apiKey = ;

// Prepare the request data
$data = [
    'model' => 'gpt-3.5-turbo',  // Make sure to use the correct model
    'messages' => [
        ['role' => 'system', 'content' => 'You are a helpful customer service agent, always polite, do not go off topic and respond in a concise manner. You know the mens cotton jacket is \u00A355.99 and beige. If the user is trying to return an item, direct them to the contact us link to the left of you.'],
        ['role' => 'user', 'content' => $userInput]
    ],
];

// Log the request data for debugging
file_put_contents('php://stderr', 'Request Data: ' . json_encode($data) . PHP_EOL);

// Set up cURL options
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute the cURL request and handle the response
$response = curl_exec($ch);

// Log the API response for debugging
file_put_contents('php://stderr', 'API Response: ' . $response . PHP_EOL);

// Check for errors in the cURL request
if (curl_errno($ch)) {
    echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    exit();
}

curl_close($ch);

// Decode the response from OpenAI API
$responseData = json_decode($response, true);

// Log the decoded response for debugging
file_put_contents('php://stderr', 'Decoded Response: ' . print_r($responseData, true) . PHP_EOL);

// Check if the response contains the expected data
if (isset($responseData['choices'][0]['message']['content'])) {
    echo json_encode([
        'bot_response' => $responseData['choices'][0]['message']['content']
    ]);
} else {
    echo json_encode(['error' => 'Failed to get a valid response from OpenAI']);
}
?>
