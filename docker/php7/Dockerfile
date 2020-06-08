FROM php:7.4-fpm

RUN apt-get -y update
RUN curl -L -C - --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar
RUN chmod 755 /usr/local/bin/composer
RUN apt-get install -y git
RUN docker-php-ext-install pdo_mysql mysqli
RUN pecl install xdebug-2.9.6 && docker-php-ext-enable xdebug
