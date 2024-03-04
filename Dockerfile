FROM wordpress:php8.1
CMD ["rm","/var/www/html/*"]
COPY . /var/www/html
RUN docker-php-ext-install pdo pdo_mysql