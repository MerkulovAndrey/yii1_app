FROM php:8.4-apache

RUN apt-get update && apt-get install -y mc libpq-dev

# Устанавливаем необходимые расширения PHP
#RUN docker-php-ext-install pdo_mysql pdo_pgsql
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

# настройки Apache
COPY ./docker/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Включаем модуль rewrite для Apache
RUN a2enmod rewrite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настройки MC
COPY docker/mc /root/.config/mc

# Опционально: настраиваем php.ini (если нужен кастомный конфиг)
COPY docker/8.4/php.ini /usr/local/etc/php/
