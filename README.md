# SLIM 4 - API SKELETON

Useful skeleton for RESTful API development, using [Slim PHP micro-framework](https://www.slimframework.com).


[![Software License][ico-license]](LICENSE.md)
[![Tests](https://github.com/maurobonfietti/slim4-api-skeleton/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/maurobonfietti/slim4-api-skeleton/actions/workflows/tests.yml)
[![Coverage Status](https://coveralls.io/repos/github/maurobonfietti/slim4-api-skeleton/badge.svg?branch=main)](https://coveralls.io/github/maurobonfietti/slim4-api-skeleton?branch=main)
[![Packagist Version](https://img.shields.io/packagist/v/maurobonfietti/slim4-api-skeleton)](https://packagist.org/packages/maurobonfietti/slim4-api-skeleton)

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat


## 💻 TECHNOLOGIES USED:

The main technologies used in this project are:

- PHP 8.4 / 8.5 / 8.6
- Slim 4
- MySQL
- PHPUnit
- dotenv
- Docker
- Docker Compose


## ⚙️ QUICK INSTALL:

### Requirements:

- Composer.
- PHP >= 8.4 (tested on 8.4, 8.5 and 8.6).
- MySQL/MariaDB.
- or Docker.


### With Composer:

You can create a new project running the following commands:

```bash
composer create-project maurobonfietti/slim4-api-skeleton [my-api-name]
cd [my-api-name]
composer test
composer start
```


#### Configure your connection to MySQL Server:

By default, the API uses a MySQL database.

You should check and edit this configuration in your `.env` file:

```
DB_HOST='127.0.0.1'
DB_NAME='yourMySqlDatabase'
DB_USER='yourMySqlUsername'
DB_PASS='yourMySqlPassword'
DB_PORT='3306'
```


### With Docker:

If you like Docker, you can use this project with **Docker** and **Docker Compose**.


**Minimal Docker Version:**

* Engine: 20.10+
* Compose: v2 (`docker compose`)


**Docker Commands:**

```bash
# Create and start containers for the API.
docker compose up -d --build

# Checkout the API.
curl http://localhost:8081

# Use PHP 8.5 instead of the default PHP 8.6 image.
PHP_VERSION=8.5 docker compose up -d --build

# Stop and remove containers.
docker compose down
```


## 📦 DEPENDENCIES:

### LIST OF REQUIRE DEPENDENCIES:

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
- [slim/psr7](https://github.com/slimphp/Slim-Psr7): PSR-7 implementation for use with Slim 4.
- [pimple/pimple](https://github.com/silexphp/Pimple): A small PHP dependency injection container.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

### LIST OF DEVELOPMENT DEPENDENCIES:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.
- [symfony/console](https://github.com/symfony/console): The Console component eases the creation of beautiful and testable command line interfaces.
- [nunomaduro/phpinsights](https://github.com/nunomaduro/phpinsights): Instant PHP quality checks from your console.
- [maurobonfietti/slim4-api-skeleton-crud-generator](https://github.com/maurobonfietti/slim4-api-skeleton-crud-generator): CRUD Generator for Slim 4 - Api Skeleton.


## 🔖 ENDPOINTS:

### BY DEFAULT:

- Hello: `GET /`

- Health Check: `GET /status`


## 📹 TUTORIAL:

Learn how to develop a RESTful API with PHP and Slim 4 by following this [video](https://youtu.be/DetK1w65S-k) [🎥 🔈 🇪🇸 🇦🇷]


https://user-images.githubusercontent.com/24535949/180607903-7efd2cfc-b1df-4ad6-8295-801585df3b83.mp4


## :heart: SUPPORT THE PROJECT

If you would like to support this project, you can:
- Invite the author a coffee :coffee: :yum:
- Give a star to the repository :star: :blush:

[![ko-fi](https://user-images.githubusercontent.com/51191974/60371721-179a2e00-99c8-11e9-86f1-83e676857f3d.png)](https://ko-fi.com/maurobonfietti)


## :sunglasses: AND THAT'S IT!

Now, go to build an excellent RESTful API.
