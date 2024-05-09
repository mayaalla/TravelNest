<?php
// fetch_location.php
$accessToken = 'your_access_token_here'; // Replace with your actual ipinfo.io access token
$userIP = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

$apiUrl = "https://ipinfo.io/{$userIP}/json?token={$accessToken}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response; // Send back the JSON response from ipinfo.io