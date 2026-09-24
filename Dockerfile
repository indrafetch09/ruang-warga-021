# syntax=docker/dockerfile:1

# =============================================================
# Ruang Warga 021 - Docker Image
# Fase 1: install dependensi composer (hanya yang dibutuhkan runtime)
# =============================================================
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction

# =============================================================
# Fase 2: Runtime (PHP Cli + built-in web server)
# =============================================================
FROM php:8.3-cli

# Extension PHP yang dibutuhkan aplikasi
RUN apt-get update \
    && apt-get install -y --no-install-recommends libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql pdo_sqlite

# Composer untuk kebutuhan dev (composer install/update di dalam container)
COPY --from=vendor /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Aplikasi & dependensi
COPY --from=vendor /app/vendor ./vendor
COPY . .

# Direktori upload harus writable oleh user proses PHP
RUN mkdir -p public/uploads/galeri public/uploads/notulensi \
    && chown -R www-data:www-data public/uploads

# Entrypoint untuk menunggu database + auto migrate & seed (opsional)
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENV DB_HOST=db \
    DB_PORT=3306 \
    DB_AUTO_MIGRATE=1 \
    WEB_PORT=8000

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]