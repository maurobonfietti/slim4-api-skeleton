#!/bin/bash

echo -e "# Restart demo database."
docker-compose exec mysql mysql -e 'DROP DATABASE IF EXISTS skel_api_slim_php ; CREATE DATABASE skel_api_slim_php;'

echo -e "# Create testing data."
docker-compose exec mysql sh -c "mysql skel_api_slim_php < docker-entrypoint-initdb.d/database.sql"

echo -e "# Run tests."
docker-compose exec php-fpm sh -c "composer test"
