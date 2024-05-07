# Laravel Blog

- Developed blog functionality using PHP, Laravel and MySQL, Redis
- Implemented user authentication and authorization features, role model
- Created an admin panel for content management
- Implemented CRUD functionality for categories, tags, posts, comments
- Data caching

## Some screenshots

You can find some screenshots of the application on: [https://imgur.com/a/Z3VySQj](https://imgur.com/a/Z3VySQj)

## Installation

Download this repository.

Setting up your development environment on your local machine:
```bash
$ cd laravel-blog
$ cp .env.example .env
$ composer install
$ php artisan key:generate
$ php artisan storage:link
```

## Before starting
You need to run the migrations with the seeds:
```bash
$ php artisan migrate --seed
```

This will create a new user that you can use to sign in:
```yml
email: admin@gmail.com
password: 12345678
```
