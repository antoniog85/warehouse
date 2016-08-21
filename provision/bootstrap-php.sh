#!/usr/bin/env bash

apt-get update
apt-get install -y git wget unzip
docker-php-ext-install mbstring pcntl pdo pdo_mysql ext-phpiredis
pecl install xdebug
docker-php-ext-enable xdebug
sed -i '1 a xdebug.remote_autostart=true' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
sed -i '1 a xdebug.remote_mode=req' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
sed -i '1 a xdebug.remote_handler=dbgp' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
sed -i '1 a xdebug.remote_connect_back=1 ' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
sed -i '1 a xdebug.remote_port=9000' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
sed -i '1 a xdebug.remote_host=127.0.0.1' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
sed -i '1 a xdebug.remote_enable=1' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# install redis
#cd /tmp
#wget https://github.com/phpredis/phpredis/archive/php7.zip -O phpredis.zip
#unzip -o /tmp/phpredis.zip && cd /tmp/phpredis && phpize && ./configure && make && make install
#touch /etc/php/mods-available/redis.ini && echo extension=redis.so > /etc/php/mods-available/redis.ini
#ln -s /etc/php/mods-available/redis.ini /etc/php/7.0/apache2/conf.d/redis.ini
#ln -s /etc/php/mods-available/redis.ini /etc/php/7.0/fpm/conf.d/redis.ini
#ln -s /etc/php/mods-available/redis.ini /etc/php/7.0/cli/conf.d/redis.ini

#echo extension=/etc/phpredis/modules/redis.so > /usr/local/etc/php/conf.d/phpredis-php7/rpm/redis.ini

php-fpm