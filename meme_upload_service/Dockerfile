FROM debian:latest

# Install necessary packages
RUN apt-get update && apt-get install apache2 libapache2-mod-php7.3 php-xml -y

# Set up app directory
COPY flag.txt /var/www/html/flag.txt
COPY index.php /var/www/html/index.php
COPY valid_message.xsd /var/www/html/valid_message.xsd
COPY validator_error_messages.php /var/www/html/validator_error_messages.php

# Create necessary folders in web dir
RUN mkdir /var/www/html/images
RUN mkdir /var/www/html/messages

# Disable PHP in /messages
RUN echo "php_flag engine off" > /var/www/html/messages/.htaccess

# Configure Apache2
COPY ./.docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf

# Give www-data control over the web files
RUN chown -R www-data:www-data /var/www/html

# Entrypoint for `Docker run`
EXPOSE 80
ENTRYPOINT ["/usr/sbin/apache2ctl","-D","FOREGROUND"]