FROM php:8.2-apache

# Install the MySQL drivers for PHP
RUN docker-php-ext-install pdo pdo_mysql

# Copy your code
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
