FROM php:8.2-fpm-alpine

#MAINTAINER hieptv <tranhieptvh@gmail.com>

# Install dependencies
RUN apk add wget \
      curl \
      git \
      build-base \
      libmcrypt-dev \
      libxml2-dev \
      linux-headers \
      pcre-dev \
      zlib-dev \
      autoconf \
      cyrus-sasl-dev \
      libgsasl-dev \
      oniguruma-dev \
      libressl \
      libressl-dev \
      supervisor\
      unzip\
      libzip-dev\
      libpng \
      libjpeg-turbo \
      freetype-dev \
      libpng-dev \
      libjpeg-turbo-dev \
        && docker-php-ext-install gd \
        && docker-php-ext-install zip

# Install extensions
RUN pecl channel-update pecl.php.net; \
    docker-php-ext-install mysqli mbstring pdo pdo_mysql xml pcntl

# Install composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install debug
ARG DEBUG=true
ENV DEBUG ${DEBUG}

RUN if [ ${DEBUG} = true ]; then \
    pecl install xdebug-3.3.2 \
    && docker-php-ext-enable xdebug \
    ;fi

RUN rm /var/cache/apk/*

# Set working directory
WORKDIR /var/www/html

# Expose port 9000
EXPOSE 9000
CMD ["php-fpm"]
