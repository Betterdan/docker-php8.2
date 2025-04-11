###### 快速搭建php开发环境

1. 前置条件
需要先建立好外部网路 local_network
```
docker network create local_network

```

2. 项目只单纯包含 nginx和php-fpm，其他中间件可以自定义（可以放一起也可以单独搞个docker-compose）
