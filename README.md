# Libraries used:

- for authentication used laravel UI https://github.com/laravel/ui and used bootstrap
- for datatables used Yajra https://yajrabox.com/docs/laravel-datatables/10.0

# Setup procedure:
- copy .env.example and create .env
- create database and update .env
- run `composer install`
- run `npm install`
- run `php artisan storage:link`
- run `php artisan migrate:fresh --seed`
- run `php artisan key:generate`
- run `npm run build`
- run `php artisan serve`
- open http://127.0.0.1:8000