```
composer install
npm install

// next command only if the .env is not present
cp .env.example .env

php artisan key:generate
php artisan migrate

php artisan serve
npm run dev
```
