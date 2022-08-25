FROM php:8.1-apache
# WORKDIR /var/www/html

# APACHE
COPY .docker/web/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod headers && \
    a2enmod rewrite && \
    a2enmod ssl

RUN apt-get update && \
    apt-get install -y --no-install-recommends apt-utils pkg-config git zip \
    build-essential libssl-dev libzip-dev libpng-dev libjpeg-dev libonig-dev unzip \
    libfreetype6-dev libmemcached-dev libmagickwand-dev jpegoptim locales

RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=en_US.UTF-8

ENV LANG en_US.UTF-8 

# NODE and YARN
RUN apt-get install curl gnupg -yq && \
    curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install nodejs -yq && \
    curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && apt-get install yarn

# RUN pecl channel-update pecl.php.net && \
#    pecl install mongodb memcached imagick mailparse && \
#    docker-php-ext-enable mongodb memcached imagick mailparse && \
#    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN docker-php-ext-install pdo pdo_mysql mysqli bcmath mbstring gd zip && \
    curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer.phar && \
    ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini
# RUN echo "extension=memcached.so" >> /usr/local/etc/php/conf.d/memcached.ini