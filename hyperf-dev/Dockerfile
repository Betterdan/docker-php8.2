# 使用官方 Hyperf 镜像（PHP 8.1 + Swoole）
FROM hyperf/hyperf:8.1-alpine-v3.18-swoole

# 设置工作目录
WORKDIR /opt/www


# 安装依赖（生产模式）
# RUN composer install --no-dev --optimize-autoloader

# 暴露端口
EXPOSE 9501

# 启动命令
CMD ["php", "bin/hyperf.php", "start"]