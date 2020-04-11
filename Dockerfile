FROM php:7-fpm-alpine as composer

RUN set -ex \
  && curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer global require hirak/prestissimo --no-plugins --no-scripts \
  && mkdir -p /var/www

WORKDIR /var/www
COPY resources resources
RUN set -ex \
  && cd resources \
  && composer install --prefer-dist --no-scripts --no-dev --no-autoloader \
  && composer dump-autoload --optimize \
  && rm -rf /root/.composer

FROM php:7-fpm-alpine
RUN set -ex \
  && apk --no-cache add --virtual .build-deps $PHPIZE_DEPS \
  && apk --no-cache add --virtual .ext-deps libmcrypt-dev freetype-dev \
     libjpeg-turbo-dev libpng-dev libxml2-dev msmtp bash openssl-dev pkgconfig \
     libzip-dev oniguruma-dev \
  && docker-php-source extract \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd mysqli pdo pdo_mysql zip opcache \
  && docker-php-ext-enable mysqli \
  && docker-php-ext-enable gd \
  && docker-php-ext-enable pdo \
  && docker-php-ext-enable pdo_mysql \
  && docker-php-source delete \
  && apk del .build-deps

COPY --from=composer /var/www/resources /var/www/resources
