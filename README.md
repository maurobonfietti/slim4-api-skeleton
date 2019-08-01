# SKEL API SLIM PHP

Skel Api Slim PHP :-)


## QUICK INSTALL:

### Pre Requisite:

- Git.
- Composer.
- PHP.
- MySQL/MariaDB.

### Run commands:

In your terminal execute this commands:

```bash
$ ### git clone https://github.com/maurobonfietti/skel-api-slim-php.git && cd skel-api-slim-php
$ cp .env.example .env
$ composer install
$ composer database
$ composer start
```


## USING DOCKER:

If you prefer, you can use this project with **docker** and **docker-compose**.


### MINIMAL DOCKER VERSION:

* Engine: 18.03+
* Compose: 1.21+


### Docker Commands:

```bash
# Create and start containers for the API.
$ docker-compose up -d --build

# Execute script to create the database and import test data from scratch.
$ ./bin/docker/restart-db.sh

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


## DOCUMENTATION:

### ENDPOINTS LIST:

- Help: `GET /`

- Status: `GET /status`
