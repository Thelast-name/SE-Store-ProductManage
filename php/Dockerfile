# Use an official PHP image as the base image
FROM php:8.2-apache

# Install pdo_mysql extension
RUN docker-php-ext-install pdo_mysql & ocker-php-ext-enable pdo_mysql

# Enable pdo_mysql extension
# RUN echo "extension=pdo_mysql" > /usr/local/etc/php/conf.d/pdo_mysql.ini

# # Copy your PHP files into the container's web directory
COPY ./img /var/www/html/img
RUN chown -R www-data:www-data /var/www/html

# # Expose port 80 for Apache
# EXPOSE 80

# # Start Apache server
# CMD ["apache2-foreground"]

RUN apt-get update && apt-get upgrade -y
