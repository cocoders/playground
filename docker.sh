#!/bin/bash

docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)

docker build --rm -t application docker/application
docker run --name application -v $(pwd):/var/www/playground application
docker run --name mysql -v /var/lib/mysql:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=test1234 -e MYSQL_DATABASE=docker -d mysql
docker build --rm -t php5 docker/php-fpm
docker run -d --link mysql:mysql --name=php5 --volumes-from application php5
docker build --rm -t nginx docker/nginx
docker run -d --link php5:php5 --volumes-from application -p 80:80 -e APP_NAME=playground nginx
