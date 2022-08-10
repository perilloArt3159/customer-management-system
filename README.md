# Customer Management System

Can't think of a fancy description for this project.  

## Table of contents

* [Contributors](#contributors)
* [Technologies](#technologies)
  * [General](#general)
  * [Composer Packages](#composer-packages)
  * [NPM Packages](#npm-packages)
* [Project Setup](#project-setup)
* [License](#license)

## Contributors

|Name  |Role | Status      |
|:----:|:-----:|:------------------|
|[perilloArt3159](https://github.com/perilloArt3159)| Full-Stack | Active

## Technologies

### General

|Name  |Version | Description      |
|:----:|:-----:|:------------------|
| [Laravel](https://laravel.com/docs/9.x)     |`9.24.0`        |PHP Back-End Framework           |
| [Vue.js](https://v3.vuejs.org/)             |`3.0.0`         |Javascript Front-End Framework   |
| [Bootstrap](https://getbootstrap.com/)      |`5.2.0`         |CSS Toolkit                      |
| [Node.js](https://nodejs.org/en/)           |`16.16.0`       |JavaScript runtime Engine        |
| [MySQL](https://www.mysql.com/)             |`8.0.0`         |Relational Database Management System        |

### Composer Packages

|Name                                                                                                           |Version          |Description                                         |
|:---------------------------------------------------------------------------------------------:                |:---------------:|:-------------------------------------------:       |
|[cviebrock/eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable)                                |`9.0.0`          |Generate Slugs for Eloquent Models                  |
|[inertiajs/inertia-laravel](https://inertiajs.com/)                                                            |`0.11.0`         |The Laravel adapter for Inertia.js                  |
|[tighten/ziggy](https://github.com/tighten/ziggy)                                                              |`1.4.6`          |Enables usage of Laravel named routes in JavaScript |

### NPM Packages

|Name                                                                                                           |Version          |Description                                    |
|:--------------------------------------------------------------------------------:                             |:---------------:|:-------------------------------------------:  |
|[Slugify](https://www.npmjs.com/package/slugify)                                                               |`1.6.2`          |Sluggify Strings                               |
|[SASS](https://sass-lang.com/)                                                                                 |`1.54.4`         |CSS Preprocessor                               |

## Project Setup

* From the project root directory, install all the composer and npm package dependencies by running the following commands.

```bash
# Install Composer Package Dependencies
$ composer install

# Install NPM Package Dependencies 
$ npm install
```

* Create a new file called `.env` then copy and paste the contents of `.env.example` or just run the following command.

```bash
# Copy .env.example to .env
$ cp .env.example .env
```

* In your `.env` file, if you disagree with the defaults, set up your correct parameters. Take note for the `DB_DATABASE` parameter, the database must be created prior in MySQL.

```bash
APP_NAME="Customer Management System"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=customer_management_system
DB_USERNAME=root
DB_PASSWORD=root
```

* Generate the `APP_KEY`.

```bash
# Command to Generate APP_KEY 
$ php artisan key:generate
```

* Run the Migrations and Seeders for the Database Tables and Seeders respectively for testing.

```bash
# Command to Migrate Tables
$ php artisan migrate:fresh 

# Command to Migrate Seeders
$ php artisan db:seed
```

* Start **Vite** to be able to build the files and also enable hot reload. It is important that you have `Node.js v16.0.0` for this to work. 

```bash
# Command to Run Vite
$ npm run dev
```

* Start the Server, then go to `http://localhost:8000` in your browser provided you did not change the default `APP_URL` parameter in your `.env`.

```bash
# Command to Run the Server
$ php artisan serve 
```

* There is already one user that was seeded in the database for the login. The Credentials are as follows.

```bash
# Username
$ admin 

# Password
$ admin
```

## License

Project is licensed under [MIT](https://mit-license.org/).
