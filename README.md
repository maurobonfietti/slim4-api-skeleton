# SLIM 4 - API SKELETON

Useful skeleton for RESTful API development, using [Slim PHP micro framework](https://www.slimframework.com).

Used technologies: `PHP, Slim 4, MySQL, PHPUnit, env var, Docker & Docker Compose`.

[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.com/maurobonfietti/slim4-api-skeleton.svg?branch=master)](https://travis-ci.com/maurobonfietti/slim4-api-skeleton)
[![Coverage Status](https://coveralls.io/repos/github/maurobonfietti/slim4-api-skeleton/badge.svg?branch=master)](https://coveralls.io/github/maurobonfietti/slim4-api-skeleton?branch=master)
[![Packagist Version](https://img.shields.io/packagist/v/maurobonfietti/slim4-api-skeleton)](https://packagist.org/packages/maurobonfietti/slim4-api-skeleton)

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat


## QUICK INSTALL:

### Pre Requisite:

- PHP.
- Composer.
- MySQL/MariaDB.


### With Composer:

You can create a new project running the following commands:

```bash
$ composer create-project maurobonfietti/slim4-api-skeleton [my-api-name]
$ cd [my-api-name]
$ composer test
$ composer start
```


#### Configure your connection to MySQL Server:

By default, the API use a MySQL Database.

You should check and edit this configuration in your `.env` file:

```
DB_HOST='127.0.0.1'
DB_NAME='yourMySqlDatabase'
DB_USER='yourMySqlUsername'
DB_PASS='yourMySqlPassword'
```


### With Docker:

If you like Docker, you can use this project with **docker** and **docker-compose**.


**MINIMAL DOCKER VERSION:**

* Engine: 18.03+
* Compose: 1.21+


### DOCKER COMMANDS:

```bash
# Create and start containers for the API.
$ docker-compose up -d --build

# Checkout the API.
$ curl http://localhost:8081

# Stop and remove containers.
$ docker-compose down
```


## DEPENDENCIES:

### LIST OF REQUIRE DEPENDENCIES:

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
- [slim/psr7](https://github.com/slimphp/Slim-Psr7): PSR-7 implementation for use with Slim 4.
- [pimple/pimple](https://github.com/silexphp/Pimple): A small PHP dependency injection container.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

### LIST OF DEVELOPMENT DEPENDENCIES:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.
- [symfony/console](https://github.com/symfony/console): The Console component eases the creation of beautiful and testable command line interfaces.
- [maurobonfietti/slim4-api-skeleton-crud-generator](https://github.com/maurobonfietti/slim4-api-skeleton-crud-generator): CRUD Generator for Slim 4 - Api Skeleton.


## ENDPOINTS:

### BY DEFAULT:

- Help: `GET /`

- Status: `GET /status`


## WOULD YOU LIKE TO SUPPORT THIS PROJECT?

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/maurobonfietti)


## That's it!

Now go build a cool RESTful API ;-)
