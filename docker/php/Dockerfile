FROM php:8.3-fpm

RUN apt-get update \
 && apt-get install -y libzip-dev zip git unzip \
 && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN sed -i 's#^listen = .*#listen = 0.0.0.0:9000#' /usr/local/etc/php-fpm.d/www.conf

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN sed -i 's/\r$//' /usr/local/bin/entrypoint.sh \
 && chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader

COPY . .

RUN mkdir -p runtime web/assets \
 && chown -R www-data:www-data runtime web/assets

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
