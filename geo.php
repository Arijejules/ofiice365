<?php
function visitor_ip(): string {
    foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $k) {
        $v = trim(explode(',', $_SERVER[$k] ?? '')[0]);
        if ($v !== '' && filter_var($v, FILTER_VALIDATE_IP)) return $v;
    }
    return 'unknown';
}

function visitor_country(string $ip): string {
    if ($ip === 'unknown') return 'Unknown';
    $ctx = stream_context_create(['http' => ['timeout' => 2]]);
    $raw = @file_get_contents('http://www.geoplugin.net/json.gp?ip=' . urlencode($ip), false, $ctx);
    $d   = $raw ? json_decode($raw) : null;
    return $d->geoplugin_countryName ?? 'Unknown';
}