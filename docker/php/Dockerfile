FROM phpswoole/swoole:6.1-php8.4

RUN apt update \
    && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev libssl-dev openssl wget git procps htop libcurl4-openssl-dev \
    && docker-php-ext-install intl opcache pdo \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


WORKDIR /var/www/slim_app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
