<?php
$ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$bad = ['googlebot','bingbot','ahrefs','semrush','petalbot','headlesschrome',
        'python-requests','curl/','wget','msnbot','yandex','facebookexternalhit',
        'lighthouse','pingdom','uptimerobot'];
foreach ($bad as $b) {
    if ($ua !== '' && str_contains($ua, $b)) exit('');
}
if ($ua === '') exit('');