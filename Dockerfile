ARG PHP_VERSION=7.2

FROM php:${PHP_VERSION}-cli

RUN pecl install xdebug

RUN apt-get update && \
    apt-get install -y autoconf pkg-config libssl-dev git zlib1g-dev

RUN docker-php-ext-install -j$(nproc) zip && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"