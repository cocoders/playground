FROM ubuntu:14.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
    acl      \
    php5-cli \
    php5-fpm \
    php5-json \
    php5-intl \
    php5-curl \
    php5-mcrypt \
    php5-mysql \
    php5-apcu \
    php5-gd \
    php5-xdebug

ADD start.sh /start.sh
ADD app_environment.sh /etc/profile.d/app_environment.sh
ADD php.ini /etc/php5/fpm/php.ini

RUN php5enmod mcrypt
RUN php5enmod php_openssl
RUN php5enmod xdebug

EXPOSE 9000

WORKDIR /var/www/playground

ENTRYPOINT ["/start.sh"]
