FROM php:8.2-fpm-alpine

WORKDIR /var/www

# 安装系统依赖和 PHP 扩展
RUN set -eux; \
    apk update; \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        freetype-dev \
        gmp-dev \
        icu-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libxml2-dev \
        libzip-dev \
        postgresql-dev \
        sqlite-dev \
        imap-dev \
        openssl-dev \
        libssh2-dev \
        oniguruma-dev \
        libxslt-dev \
        yaml-dev \
        musl-dev \
        linux-headers \
        libsodium-dev; \
    \
    # 配置 GD 扩展
    docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp; \
    \
    # 配置 IMAP 扩展
    docker-php-ext-configure imap --with-imap --with-imap-ssl; \
    \
    # 安装核心扩展
    docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" \
        bcmath \
        ctype \
        dom \
        exif \
        fileinfo \
        filter \
        gd \
        gmp \
        intl \
        imap \
        mysqli \
        pcntl \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        simplexml \
        soap \
        sockets \
        sysvmsg \
        sysvsem \
        sysvshm \
        xsl \
        zip; \
    \
        # 调试：列出所有已安装的扩展
        ls -la /usr/local/lib/php/extensions/no-debug-non-zts-*/; \
    # 安装 PECL 扩展
    pecl update-channels; \
    pecl install apcu;\
    pecl install mongodb;\
    pecl install redis;\
    pecl install yaml;\
    pecl install ssh2;\

    \
    # 安装 xdebug
    pecl install xdebug; \
    ls -la /usr/local/lib/php/extensions/no-debug-non-zts-*/xdebug*; \

    \

    # 启用所有 PECL 扩展
    docker-php-ext-enable \
        apcu \
        mongodb \
        redis \
        ssh2 \
        yaml \
        xdebug \
        opcache; \
    \
    # 配置 xdebug
    echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    \
    # 配置 opcache
    echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.jit_buffer_size=64M" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    \
    # 验证
    php -m; \
    ls -la /usr/local/lib/php/extensions/no-debug-non-zts-*/

    \
# 安装 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./php/local.ini /usr/local/etc/php/conf.d/99-php.ini

# 设置权限
RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]