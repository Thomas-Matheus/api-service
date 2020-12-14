PHP CHALLENGE
========================

Welcome to the Symfony Project for PHP Challenge.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

### First
Clone the project

Repository: [PHP-CHALLENGE](https://github.com/viniciuseneas/api-service)

### Requirements
Symfony
- 4.4

For Docker
- [Docker](https://www.docker.com/get-started)
- [Docker compose](https://docs.docker.com/compose/install/)

JWT authentication
- OpenSSL library

If you are not going to use Docker
- composer
- php-7.4
- mysql

### Another Documentations

- [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)

### Technology

| - PHP 7.4 |

| - MYSQL 8.0.19 |

| - GIT | - COMPOSER |

| - DOCKER | - DOCKER-COMPOSE |

| DDD | CLEAN CODE |

Initial setting
--------------

Edit hosts:

    $ sudo vim /etc/hosts
    127.0.0.1 dev.service.com mysql

Composer command:

    composer install

Create the database and tables:

    sql-files/api-service.sql

### To use Docker

    docker-compose up -d

### Authentication

To authenticate you'll need do generate SSH KEYS:

##### Generate the SSH keys :

``` bash
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

#### Configuration

Configure your `.env` with the ssh pass phrase under `JWT_PASSPHRASE`:

``` yaml
JWT_PASSPHRASE:  '' # ssh key pass
```

### Authenticating

Send a post to `/api/register` with the `username` and `password`, as follow:

``` bash
$ curl -X POST http://localhost:8000/register -d _username=guest -d _password=12345
-> User Guest successfully created
```

The post will return a Token. With this token you'll be able to access the api resources.

New Token

``` bash
$ curl -X POST -H "Content-Type: application/json" http://localhost:8000/login_check -d '{"username":"guest","password":"12345"}'
-> { "token": "[TOKEN]" }
```

### API DOC

``` apidoc
https://github.com/nelmio/NelmioApiDocBundle
```

[1]:  https://symfony.com/doc/4.4/setup.html
