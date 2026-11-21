#!/bin/sh
set -eu

php artisan migrate --force
php artisan db:seed --class=ApartmentSeeder --force

exec apache2-foreground
