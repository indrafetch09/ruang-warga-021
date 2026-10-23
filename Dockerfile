FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction


FROM php:8.5-cli

RUN apt-get update \
  && apt-get install -y --no-install-recommends libsqlite3-dev \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install pdo_mysql pdo_sqlite

COPY --from=vendor /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN mkdir -p public/uploads/galeri public/uploads/notulensi \
  && chown -R www-data:www-data public/uploads

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENV DB_HOST=db \
  DB_PORT=3306 \
  DB_AUTO_MIGRATE=1 \
  WEB_PORT=8000

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
