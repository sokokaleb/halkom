#!/bin/bash

php artisan migrate:refresh
php artisan db:seed
chmod -R 777 ./public
chmod -R 777 ./app/storage