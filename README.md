# SLIM 4 - API SKELETON

Skeleton for RESTful API development, using [Slim PHP micro framework](http://www.slimframework.com).

Used technologies: PHP, Slim 4, MySQL, PHPUnit, env var, Docker & Docker Compose.

## QUICK INSTALL:

### Pre Requisite:

- Git.
- Composer.
- PHP.
- MySQL/MariaDB.

### Run commands:

In your terminal execute this commands:

```bash
$ composer create-project maurobonfietti/slim4-api-skeleton [your-new-api-name]
$ cd [your-new-api-name]
$ cp .env.example .env
$ composer test
$ composer start
```


#### Check and configure your MySQL database connection:

By default, the API will need a MySQL Database.

You can check and edit this configuration in your `.env` file:

```
DB_HOSTNAME='127.0.0.1'
DB_DATABASE='slim4_api_skeleton'
DB_USERNAME='oneUser'
DB_PASSWORD='onePass'
```

You can create a mysql database executing for example:

```bash
$ mysql -e "CREATE DATABASE slim4_api_skeleton"
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
- [maurobonfietti/slim4-api-skeleton-crud-generator](https://github.com/maurobonfietti/slim4-api-skeleton-crud-generator): CRUD Generator for Slim 4 - Api Skeleton.


## DOCUMENTATION:

### ENDPOINTS BY DEFAULT:

#### Get Help:

Request:
```bash
$ curl -X GET localhost:8080
```

Response:
```javascript
{
    "api": "slim4-api-skeleton",
    "version": "0.0.1",
    "timestamp": 1570930920
}
```


#### Get Status:

Request:
```bash
$ curl -X GET localhost:8080/status
```

Response:
```javascript
{
    "status": {
        "database": "OK"
    },
    "api": "slim4-api-skeleton",
    "version": "0.0.1",
    "timestamp": 1570930935
}
```


## That's it!

Now go build a cool RESTful API ;-)
