FROM php:8.3-cli

WORKDIR /var/app

COPY --from=composer:2.7.7 /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y git curl zip unzip libicu-dev \
	&& pecl install xdebug \
	&& docker-php-ext-configure intl \
	&& docker-php-ext-install pdo_mysql intl \
	&& docker-php-ext-enable xdebug

