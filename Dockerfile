FROM php:7.4-cli

RUN apt-get update &&\
    apt-get install -qy wget git libfann-dev &&\
    rm -r /var/lib/apt/lists/* &&\
    pecl install fann &&\
    docker-php-ext-enable fann

ARG COMPOSER_VERSION="1.6.3"
RUN wget -O /usr/bin/composer https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar \
    && chmod +x /usr/bin/composer
