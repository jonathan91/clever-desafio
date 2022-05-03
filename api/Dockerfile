FROM php:7.4-apache

WORKDIR /var/www/api

RUN apt-get update
RUN apt-get install -y apt-utils zip libpq-dev zlib1g-dev libzip-dev libxml2-dev libsqlite3-dev
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

COPY . /var/www/api
COPY ./docker/apache_config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/php_config/php.ini /usr/local/etc/php/conf.d/php-extras.ini

RUN apt-get install -y git zlib1g-dev \
 && docker-php-ext-install zip \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod -R o+w /var/www/api
RUN a2enmod rewrite

#ENTRYPOINT ["sh", "docker/entrypoint.sh"]
#CMD ["/etc/init.d/apache2 reload", "-D", "FOREGROUND"]
EXPOSE 80