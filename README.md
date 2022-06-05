# Test Project

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Download and install [MySQL Workbench](https://www.mysql.com/products/workbench/).
Download and install [Postman](https://www.postman.com/downloads/).
Download and install [MAMP](https://www.mamp.info/en/downloads/).

Create database with credentials that matches .env file ie
```sh
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=8889
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=root
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
```

### Set up project

Create empty directory for project:


Clone backend project:

```sh
git clone https://github.com/savo-simic/TestWork-002-
```

In your favorite IDE open `project` directory, and:

Now from  directory you should be able to start app using terminal.

Start:

```sh
php artisan serve
```


Run composer install
```sh
composer install
```

Run migrations
```sh
php artisan migrate
```


### API example routes
Get a list of all products
```sh
http://localhost:8000/api/products?api_key=test
```







