FROM php:8.2-apache

RUN apt-get update && apt-get install -y msmtp-mta && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite expires headers
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY . /var/www/html/
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]