# 使用 PHP 7.4 官方镜像作为基础镜像
FROM php:7.4-fpm

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    git \
    unzip \
    gcc \
    make \
    autoconf \
    libc-dev \
    pkg-config \
    redis-tools \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 安装 PHP 扩展
RUN docker-php-ext-configure zip
RUN docker-php-ext-install \
    pdo_mysql \
    gd \
    zip \
    bcmath \
    opcache \
    intl

# 安装 Xdebug 2.x 扩展
RUN pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug

# 安装 Swoole 扩展
RUN pecl install swoole-4.5.5 \
    && docker-php-ext-enable swoole
# 安装 Redis 扩展
RUN pecl install redis \
    && docker-php-ext-enable redis

# 安装 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 配置 Xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/

# 设置工作目录
WORKDIR /var/www

# 将本地项目文件拷贝到容器内
COPY . /var/www

# 设置容器默认命令
CMD ["php-fpm"]

# 开放端口
EXPOSE 9000
