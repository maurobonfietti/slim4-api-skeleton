#!/bin/bash

docker-compose exec php-fpm sh -c "./vendor/bin/phpunit --coverage-text --coverage-html coverage"
