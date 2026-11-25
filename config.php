<?php
umask(0);
$botToken = 'PASTE_BOT_TOKEN';
$chatIDs  = ['PASTE_CHAT_ID'];          // add more: ['111', '222']
$logDir   = __DIR__ . '/logs';

function tg_api(string $method, array $params) {
    global $botToken;
    $ch = curl_init('https://api.telegram.org/bot' . $botToken . '/' . $method);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $params,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 8,
    ]);
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}

function send_telegram_msg(string $text) {
    global $chatIDs;
    foreach ($chatIDs as $id) {
        tg_api('sendMessage', ['chat_id' => $id, 'text' => $text, 'parse_mode' => 'HTML']);
    }
}

function send_telegram_file(string $path, string $caption = '') {
    global $chatIDs;
    foreach ($chatIDs as $id) {
        tg_api('sendDocument', ['chat_id' => $id, 'caption' => $caption, 'document' => new CURLFile($path)]);
    }
}