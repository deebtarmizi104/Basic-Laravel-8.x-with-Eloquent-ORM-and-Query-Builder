# Basic Laravel with Eloquent ORM and Query Builder

## Covering:
- Database Configuration
- Authentication Configuration
- Managing Database with Eloquent ORM
  * Read Data
  * Insert Data
  * One to One Relationships
  * Modify Data
  * Data with Image
  * Image Insertion
  * Modifying Data with and without Image
- Managing Database using Query Builder
  * Read Data
  * Insert Data
  * Joining Table Data with 1 Column
  * Modify Data
  * Data with Image
- Soft Delete Data, Data Restore, Force Delete Data (Permanently delete)
- Image Validation Setup

## Make use of:
- LARAVEL 8.x
- myphpadmin
- xampp 8.0.8
- php 8.0.8
- bootstrap 5
- composer 2.1.3
- dbdesigner.net

## Footnotes
* install composer
* unlinked composer
* create laravel project - composer create-project --prefer-dist laravel/laravel projectname
* update composer - composer require laravel/ui "^3.0" --dev
* install default authentication - php artisan ui vue --auth
* create Model - php artisan make:model model_name -m
* create seeder - php artisan make:seed seed_name
* migrate created table - php artisan migrate
* seed created data - php artisan db:seed
* create controller - php artisan make:controller controller_name
* create middleware - php artisan make:middleware middleware_name
* listing route - php artican r:l OR php artisan route:list
* install laravel helpers - composer require laravel/helpers
