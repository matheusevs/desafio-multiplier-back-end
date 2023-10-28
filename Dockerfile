FROM php:8.1-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY --chown=wwwcbz:wwwcbz . /var/www
COPY .env /var/www/.env

WORKDIR /var/www

RUN adduser -g 'Nginx www user' -h /var/www/ wwwcbz -D \
    && apk update \
    && apk add --no-cache \
    nginx \
    curl-dev \
    freetype \
    libpng \
    libpq-dev \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli exif curl \
    && composer install \
    && php artisan key:generate \
    # && php artisan migrate \
    # && php artisan db:seed --class=ClientesTableSeeder \
    && chmod -R 777 /var/www/storage/ 

EXPOSE 80

CMD ["/bin/ash", "-c", "php-fpm -D && nginx -g 'daemon off;'"]