## About SaveTrace

_SaveTrace is a Final Year Project by students of UoW_

SaveTrace is a Healthcare Customer Relationship Management Web Platform built using [Laravel Framework](https://laravel.com/).

## Prerequisites

Install the following:

-   PHP 8.0.0
-   composer 2.0.8
-   XAMPP
-   npm

## Clone project to local directory

```
git clone https://github.com/jasonngjh/savetrace.git
```

## Setup

### Installing Required Dependencies

Install all of the project dependencies

```
cd savetrace
composer install --ignore-platform-reqs
npm install
copy .env.example .env (windows) / cp .env.example .env (bash)
php artisan key:generate
php artisan storage:link
```

### Starting Database

1. Start XAMPP
2. Under Manage Servers, start both MySQL Database and Apache
3. Open Web Browser and go to localhost/phpmyadmin
4. Create database name 'savetrace'

### Setup Database

```
cd savetrace
php artisan migrate
php artisan db:seed
```

## Local Development

To run the web platform locally for development:

```
cd savetrace
php artisan serve
```

Then navigate to localhost:8000.
