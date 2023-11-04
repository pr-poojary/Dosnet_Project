<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/oauth2/token/');     
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$payload = Array(
    'grant_type' => 'client_credentials',
    'client_id' => 'test_7PEOjsCVe8jx3CQsQz9YajcyAj3qNME0O5B',
    'client_secret' => 'test_uADgkxecVpWVgq2jwA5YPUoFI1Vxx9nNS0fplLcDZLijJxNmHS0aNF7v1Bs0ipNHj4r1pg8XNhqj3eVLc7xoD2xjefD6iEYXITZNaebhzrfTpHKFfrRcj5ketPz'
  );

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

echo $response;

?>