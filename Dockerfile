FROM yiisoftware/yii2-php:7.4-fpm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www