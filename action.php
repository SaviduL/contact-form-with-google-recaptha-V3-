<?php

$recaptcha_secret_key = 'secret key';
$recaptcha_response = $_POST['recaptcha_response'];

$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => $recaptcha_secret_key,
    'response' => $recaptcha_response
);

$options = array(
    'http' => array(
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$response = file_get_contents($verify_url, false, $context);
$result = json_decode($response);

if ($result->success) {

    echo 'reCAPTCHA verification successful. Form submitted.';
} else {

    echo 'reCAPTCHA verification failed. Please try again.';
}


