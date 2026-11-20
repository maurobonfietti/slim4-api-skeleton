ARG PHP_VERSION=8.6
FROM php:${PHP_VERSION}-fpm

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY --from=ghcr.io/php/pie:bin /pie /usr/local/bin/pie

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libtool libonig-dev $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mysqli mbstring

# Xdebug (debugging & code coverage), installed with PIE: PECL is no longer shipped in the PHP 8.6 images.
# Xdebug 3.5 supports PHP <= 8.5, so on PHP 8.6 it is skipped until a compatible release is available.
RUN pie install xdebug/xdebug \
    || echo "Xdebug is not available for PHP ${PHP_VERSION} yet, skipping."
