# Use an official PHP runtime as a parent image
FROM jkaninda/nginx-php-fpm:8.2

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application code into the container
COPY . .

# Install PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd

# Expose the port Apache listens on
EXPOSE 80

# Start Apache when the container runs
CMD ["systemctl restart php8.1-fpm.service"]