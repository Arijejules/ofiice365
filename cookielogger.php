<?php
$dir = __DIR__ . '/logs';
if (!is_dir($dir)) mkdir($dir, 0777, true);

$line = sprintf("[%s] %s | %s | %s | %s\n",
    date('c'),
    visitor_ip(),
    $_SERVER['REQUEST_METHOD'] ?? '-',
    $_SERVER['HTTP_USER_AGENT'] ?? '-',
    $_SERVER['QUERY_STRING'] ?? ''
);

file_put_contents($dir . '/visits.txt', $line, FILE_APPEND | LOCK_EX);