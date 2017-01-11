FROM php:7.0-apache

# install the PHP extensions we need
RUN apt-get update && apt-get install -y \
    libpng12-dev \
    libjpeg-dev \
    libpq-dev \
    libmcrypt-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install gd mbstring opcache mysqli pdo pdo_mysql pdo_pgsql zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install cli tools
RUN apt-get update && apt-get install -y \
    vim \
    nano \
    less

# Enable Apache mod_rewrite
RUN a2enmod rewrite
RUN a2enmod headers

RUN usermod -u 1000 www-data

# Install WP-CLI, see https://wp-cli.org/docs/installing/
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/apache2/access.log
RUN ln -sf /dev/stderr /var/log/apache2/error.log
