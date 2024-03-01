# ------------------------------
# MIZZY x CAPROVER LAMP STACK
# ------------------------------

# Apache + PHP Install
# ------------------------------
FROM php:8-apache
RUN apt-get update && apt-get install -y

WORKDIR /var/www/html
COPY . ./

# Install PHP Extensions
# ------------------------------
RUN docker-php-ext-install -j$(nproc) iconv intl xml soap opcache pdo pdo_mysql mysqli \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install and configure MySQL
# ------------------------------
RUN apt-get install default-mysql-server -y
