Symfony 3 single command app example
-------------

- PHP 7
- DI
- Prophecy
- Dockerized

**Dev:**

Create *dc.dev.yml*:
```
version: '2'

services:
  php:
    extends:
      file: dc.common.yml
      service: php
    volumes:
      - .:/app
```
Run these commands:
```
docker-compose -f dc.dev.yml up -d
docker exec -it -u php sfsinglecmdapp_php_1 bash
composer install
php cmd run
```
