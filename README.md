# SLIM 4 - API SKELETON

Skeleton for RESTful API development, using [Slim PHP micro framework](http://www.slimframework.com).

Used technologies: PHP, Slim 4 microframework, MySQL, PHPUnit, env var, Docker & Docker Compose.

## QUICK INSTALL:

### Pre Requisite:

- Git.
- Composer.
- PHP.
- MySQL/MariaDB.

### Run commands:

In your terminal execute this commands:

```bash
$ git clone https://github.com/maurobonfietti/slim4-api-skeleton && cd slim4-api-skeleton
$ cp .env.example .env
$ composer install
$ composer test
$ composer start
```


## DOCKER READY:

If you like Docker, you can use this project with **docker** and **docker-compose**.


### MINIMAL DOCKER VERSION:

* Engine: 18.03+
* Compose: 1.21+


### Docker Commands:

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
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.

### LIST OF DEVELOPMENT DEPENDENCIES:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.
- [maurobonfietti/skel-api-slim-php-crud-generator](https://github.com/maurobonfietti/skel-api-slim-php-crud-generator): CRUD Generator for Rest-Api-Slim-PHP Skeleton.


## DOCUMENTATION:

### DEFAULT ENDPOINTS:

- Help: `GET /`

- Status: `GET /status`
