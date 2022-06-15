# Laravel Template API

## About

This is a RESTful API template with Laravel. A good number of elements are configured and put in place to facilitate development instead of starting from scratch, Using <a href="https://jwt-auth.readthedocs.io/" target="_blank">JWT Authenticator</a>

## Installation

After cloning the project, you must use the package manager <a href="https://getcomposer.org/" target="_blank">Composer</a> to install all dependencies.

* Cloning project

```bash
git clone https://github.com/bolenge/laravel-template-api.git
```

* Installation dependencies

```bash
composer install
```

## Initialization

- Rename file .env.example to .env
- Update database and other informations

* Generate app key (If you don't have APP_KEY value in .env)

```bash
php artisan key:generate
```

* JWT token

```bash
php artisan jwt:secret
```

* Run Migrations

```bash
php artisan migrate
```

* Generate Storage link

```bash
php artisan storage:link
```

* Initialize seeds

```bash
php artisan db:seed
```

* Run tests

```bash
php artisan test
```

* Start server

```bash
php artisan serve
```

## Api Documentation

- e.g : [localhost:8000/api/docs](http://localhost:8000/api/docs)

## App Home Page

- e.g : [localhost:8000](http://localhost:8000)

## Contributing
- [@bolenge](https://github.com/bolenge)

## License

[MIT license](https://opensource.org/licenses/MIT).