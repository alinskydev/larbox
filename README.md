## About Larbox

Larbox is a starter kit based on [Laravel framework](https://laravel.com). It is being developed according to the principles of DRY and KISS. 

## Requirements
- PHP version >= PHP 8.0
- PostgreSQL version >= 12 **(Recommended)** or MySQL version >= 5.7

## Installation

**Downloading:** clone repository
```
git clone https://github.com/alinskydev/larbox.git {your-project-name}
```
comment this line in {your-folder}/app/Providers/SingletonServiceProvider.php
```
app('language');
```
open your project folder
```
cd {your-project-name}
```
install all required packages
```
composer install
```

**Configurating:** create **.ENV** file in the root foolder and fill all configuration inside it.

***Attention:*** if you want to use MySQL, then you need to change some migrations' columns with **JSON** data type, because MySQL (at least 5.7) doesn't suppport default value for this column type.

**Migrating DB:** run
```
php artisan migrate:fresh --seed
```
to import all migrations and fill DB with test data.
...and finally uncomment this line in {your-folder}/app/Providers/SingletonServiceProvider.php
```
app('language');
```

## Folders structure

Main folders you need:
- **app** - contains Laravel core files and custom starter-kit's classes.
- **modules** - made for project modules. Each module can have it's own migrations, models, resources, etc.
- **http** - working with HTTP requests. All folders inside are separated by application sections. Each section can have it's own controllers, requests, routes, feature tests, etc. If you want you can use custom model for admin and public parts using inheritance of model from **modules** folder.
- **vue** - VueJS starter-kit for admin panel.

***Advice:*** if you don't know how to start, take a look at **Box** module. It has a lot of useful examples... and do it in the same way ;)

## Documentation
In progress...

## Reporting

Let me know (open an issue) about **bugs to fix** and **features to add**. Or contact me using "My contacts" section below.

## My contacts

- [LinkedIn](https://www.linkedin.com/in/dmitry-alinsky)
- [Telegram](https://t.me/alinsky)
- [Email](mailto:alinsky.dmitry@gmail.com)

## Financial support

I don't need in any kind of financial support now. But if you want to gratitude me with any kind of donation, visit Laravel [Patreon page](https://patreon.com/taylorotwell).