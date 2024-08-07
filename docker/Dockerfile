FROM php:8.2-fpm

RUN sed -i 's/9000/9012/' /usr/local/etc/php-fpm.d/zz-docker.conf

WORKDIR /var/www/uls

ENV TZ=Asia/Manila

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y\
    libzip-dev \
    curl \
    zip \
    unzip\
    libfreetype-dev\
    libjpeg62-turbo-dev\
    libpng-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql\
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/uls

# Change current user to www
USER www

CMD ["php-fpm"]
