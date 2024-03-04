FROM php:8.1.27-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
CMD ["apache2ctl", "-D", "FOREGROUND"]