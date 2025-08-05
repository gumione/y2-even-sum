#!/bin/sh
set -e

# при первом запуске, если /var/www/vendor пуст или не существует
if [ ! -d /var/www/vendor ] || [ -z "$(ls -A /var/www/vendor)" ]; then
  composer install --no-dev --optimize-autoloader
fi

# запускаем переданную команду (php-fpm)
exec "$@"
