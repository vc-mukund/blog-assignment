<h1 align="center">Laravel-Blog</h1>

## System Requirements

The following are required to function properly.

*   Laravel Version: 9.41.0
*   PHP Version: 8.1.10
*   Composer Version: 2.4.4
## Instroduction

This project is about Blog Management.

Let's say, you are building application for Blog Management. It has feature like a backend with Spatie/Role authorization. It has other feature such as email varification mail, User/Role management, Blog management, searchable/sortable tables built on table plugin, and much more.  

[ViitorCloud](https://github.com/viitoradmin)

## Install

You can create new blog project using git clone

	git clone "repo url"

After the project is created run the following commands

	cd blog

Fetch the all code from remote branches to local branches

	git fetch --all

Assuming you've already installed composer on your machine: 2.4.4, [Composer](https://getcomposer.org)

    composer self-update or composer self-update --2

Switch git branch in your local

    master - for production

    staging - for QA

    development - for developers

    git checkout development

Create your branch for your work.

    git checkout -b feature/usermodule // from development branch
    Please follow the GIT standards mentioned in this file

Install the dependencies using composer

	composer install

Copy the environment from .env.example to .env and add database connection

    copy .env.example to .env

Then generate application key

    php artisan key:generate

Then create storage link

    php artisan storage:link

#### Update configuration File

we need to add set configuration on env file and database configuration file. you you need to set env file with check database configuration.

Let's updated files:

.env

```env

DB_DATABASE=assignment
DB_USERNAME=root
DB_PASSWORD=
```

Then run the migrations

    php artisan migrate:fresh

or Import database if you were shared by team

Then run the seeders(if you fired migrate command)

	php artisan db:seed

Now you can run project

Start the local development server

    php artisan serve

	You can now access the server at http://localhost:8000

Or You can create virtual host and execute the project in your local system.

#### Demo Credentials

**Admin:** admin@admin.com  
**Password:** password