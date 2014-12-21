FROM ubuntu:14.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
    git \
    curl \
    mysql-client \
    php5-cli \
    php5-mcrypt \
    php5-apcu \
    php5-json \
    php5-intl \
    php5-curl \
    php5-mysql \
    php5-xdebug \
    acl

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ADD entrypoint.sh /entrypoint.sh
ADD app_environment.sh /etc/profile.d/app_environment.sh

RUN php5enmod xdebug

VOLUME /var/www/playground
WORKDIR /var/www/playground

ENTRYPOINT ["/entrypoint.sh"]
CMD ["echo", "hello"]
