php artisan nano:dbdump
php artisan migrate:reset
rm -fR database/migrations/*
composer dumpautoload
php artisan nano:build -vvv
php artisan migrate
php artisan nano:dbimport
gulp
