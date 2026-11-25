#!/bin/sh
mkdir -p /var/www/html/logs
chown -R www-data:www-data /var/www/html/logs
chmod 775 /var/www/html/logs
exec "$@"