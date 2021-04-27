#!/bin/bash
composer create-project laravel/laravel projecteFinal
cd projecteFinal
chmod 777 storage -R
chmod 777 bootstrap -R
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
