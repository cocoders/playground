#!/bin/bash

sed -i "s@listen = /var/run/php5-fpm.sock@listen = 9000@" /etc/php5/fpm/pool.d/www.conf

echo "env[APP__DATABASE_HOST] = ${MYSQL_PORT_3306_TCP_ADDR}" >> /etc/php5/fpm/pool.d/www.conf
echo "env[APP__DATABASE_PORT] = ${MYSQL_PORT_3306_TCP_PORT}" >> /etc/php5/fpm/pool.d/www.conf
echo "env[APP__DATABASE_NAME] = ${MYSQL_ENV_MYSQL_DATABASE}" >> /etc/php5/fpm/pool.d/www.conf
echo "env[APP__DATABASE_USER] = root" >> /etc/php5/fpm/pool.d/www.conf
echo "env[APP__DATABASE_PASSWORD] = ${MYSQL_ENV_MYSQL_ROOT_PASSWORD}" >> /etc/php5/fpm/pool.d/www.conf
echo "env[APP__DATABASE_PASSWORD] = ${MYSQL_ENV_MYSQL_ROOT_PASSWORD}" >> /etc/php5/fpm/pool.d/www.conf


#sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs
#sudo setfacl -dR -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs

exec /usr/sbin/php5-fpm --nodaemonize
