FROM php:7.2.34-fpm

RUN apt-get update \
    && apt-get install -y libbz2-dev libzmq3-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
        libmcrypt-dev libevent-dev libssl-dev libzip-dev zip unzip unixodbc-dev libxml2-dev libxslt-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
    && docker-php-ext-install -j$(nproc) bz2 gd pdo_odbc bcmath calendar dba exif \
        gettext mysqli pcntl sockets pdo_mysql shmop sysvmsg sysvsem sysvshm opcache wddx xsl \
    && pecl install igbinary-3.1.2 mcrypt-1.0.3 zip-1.19.0 redis-5.3.1 zmq-beta \
    && docker-php-ext-enable igbinary mcrypt zip redis zmq

COPY composer /usr/local/bin/composer
COPY php.ini /usr/local/etc/php/php.ini
