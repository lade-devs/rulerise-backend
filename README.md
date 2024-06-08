# Configuration
After cloning the repo, run the command
````
composer install
````
Generate key for
````
php artisan key:generate
````
Database migration
````
php artisan migrate
````
Dummy user seeder
````
php artisan db:seed --class=UserSeeder
````
## User Authorization Test
To test between admin and user authorization visit the routes: /user/asAdmin or /user/asUser once you are logged in.

