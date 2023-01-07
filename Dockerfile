FROM php:alpine

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    imagemagick-dev \
    libtool \
    libxml2-dev \
    postgresql-dev \
    sqlite-dev

# Install production dependencies
RUN apk add --no-cache \
    bash \
    curl \
    g++ \
    gcc \
    git \
    imagemagick \
    libc-dev \
    libpng-dev \
    make \
    mysql-client \
    nodejs \
    nodejs-npm \
    yarn \
    openssh-client \
    postgresql-libs \
    rsync \
    zlib-dev \
    libzip-dev

# Install PECL and PEAR extensions
RUN pecl install \
    imagick

# Install and enable php extensions
RUN docker-php-ext-enable \
    imagick
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-install \
    curl \
    iconv \
    mbstring \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    pcntl \
    tokenizer \
    xml \
    gd \
    zip \
    bcmath

# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Install PHP_CodeSniffer
RUN composer global require "squizlabs/php_codesniffer=*"

# Cleanup dev dependencies
RUN apk del -f .build-deps

# Setup working directory
WORKDIR /var/www

COPY composer.json composer.json
#COPY composer.lock composer.lock
COPY . .
RUN composer dump-autoload

RUN php artisan key:generate
RUN php artisan jwt:secret
RUN chmod 777 -R storage

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
