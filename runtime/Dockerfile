FROM php:8.4-fpm

WORKDIR /srv/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql bcmath pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/log/php-fpm /var/log/laravel /srv/storage/framework/views /srv/storage/logs \
    && chown -R www-data:www-data /var/log/php-fpm /var/log/laravel /srv/storage \
    && chmod -R 755 /srv /var/log/laravel \
    && chmod -R 775 /var/log/php-fpm /srv/storage/framework /srv/storage/logs

EXPOSE 9000
CMD ["php-fpm"]
