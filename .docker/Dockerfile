FROM php:8.2-fpm-alpine

#MAINTAINER hieptv <tranhieptvh@gmail.com>

# Install dependencies
RUN apk add --no-cache \
    autoconf \
    build-base \
    curl \
    cyrus-sasl-dev \
    freetype-dev \
    git \
    icu-dev \
    libgsasl-dev \
    libjpeg-turbo \
    libjpeg-turbo-dev \
    libmcrypt-dev \
    libpng \
    libpng-dev \
    libressl \
    libressl-dev \
    libxml2-dev \
    libzip-dev \
    linux-headers \
    oniguruma-dev \
    pcre-dev \
    supervisor \
    unzip \
    wget \
    zlib-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip

# Install PHP extensions
RUN pecl channel-update pecl.php.net \
    && docker-php-ext-install \
        mysqli \
        mbstring \
        pdo \
        pdo_mysql \
        xml \
        pcntl \
        intl \
        opcache \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install debug tools
ARG DEBUG=true
ENV DEBUG ${DEBUG}

RUN if [ ${DEBUG} = true ]; then \
    pecl install xdebug-3.3.2 \
    && docker-php-ext-enable xdebug \
    ;fi

# Create necessary directories and set permissions
RUN mkdir -p /var/log/php \
    /var/www/html \
    && chmod -R 777 \
        /var/log/php \
    && chown -R nobody:nobody \
        /var/log/php \
        /var/www/html

# Clean up
RUN rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

# Set working directory
WORKDIR /var/www/html

# Expose port 9000
EXPOSE 9000

# Use php-fpm default configuration
CMD ["php-fpm"]
