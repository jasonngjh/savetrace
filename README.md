## About SaveTrace

_SaveTrace is a Final Year Project by students of UoW_

SaveTrace is a Healthcare Customer Relationship Management Web Platform built using [Laravel Framework](https://laravel.com/).

## Prerequisites

Install the following:

-   PHP 8.0.0
-   composer 2.0.8
-   XAMPP

## Clone project to local directory

```
git clone https://github.com/jasonngjh/savetrace.git
```

## Setup

### Installing Required Dependencies

Install all of the project dependencies

```
cd savetrace
composer install
npm install
```

### Starting Database

1. Start XAMPP
2. Under Manage Servers, click on MySQL Database and Start

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
