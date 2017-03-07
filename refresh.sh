php artisan nano:dbdump
php artisan migrate:reset
rm -fR database/migrations/*
composer dumpautoload
php7 artisan nano:build -vvv
php artisan migrate
php artisan nano:dbimport
gulp
