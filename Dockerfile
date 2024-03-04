FROM php:8.1-apache
COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
CMD ["a2enmod","rewrite"]
CMD ["systemctl","restart","apache2"]