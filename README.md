## About Larbox

Larbox is a starter kit based on [Laravel framework](https://laravel.com). It is being developed according to the principles of DRY and KISS.

## Requirements

-   PHP version >= PHP 8.1
-   PostgreSQL version >= 14 **(I haven't tested on earlier versions... but also I haven't used any modern syntax; MySQL needs some adaptation fixes... RUN TESTS AFTER INSTALL)**

## Installation (backend)

1. Download repository: [Link](https://github.com/alinskydev/larbox/archive/refs/heads/main.zip)
2. Open your project folder
3. Install all required packages
```
composer install
```
4. Create **.env** file from **.env.example** in the root folder and fill all configurations inside it (APP_, DB_, etc.).
5. Generate new application key
```
php artisan key:generate
```
6. Run to import all DB migrations and fill DB with test data
```
php artisan larbox:migrate
```
7. Install Telescope
```
php artisan telescope:install
```

## Installation (admin panel frontend)

1. Open {your_project_folder}/vue and run
```
npm install
```
2. Fill **.env.development** and **.env.production**
3. Now you can run
```
npm run dev
```

## Folders structure

Main folders you need:

-   **app** - contains Laravel core files and custom starter-kit's classes.
-   **modules** - made for project modules. Each module can have it's own migrations, models, resources, etc.
-   **http** - working with HTTP requests. All folders inside are separated by application sections. Each section can have it's own controllers, requests, routes, feature tests, etc. If you want you can use custom model for admin and public parts using inheritance of model from **modules** folder.
-   **vue** - VueJS starter-kit for admin panel.

**_Advice:_** if you don't know how to start, take a look at **Box** module. It has a lot of useful examples... and do it in the same way ;)

## Documentation

In progress...

## Reporting

Let me know (open an issue) about **bugs to fix** and **features to add**. Or contact me using "My contacts" section below.

## My contacts

-   [LinkedIn](https://www.linkedin.com/in/dmitry-alinsky)
-   [Telegram](https://t.me/alinsky)
-   [Email](mailto:alinsky.dmitry@gmail.com)

## Financial support

I don't need in any kind of financial support now. But if you want to gratitude me with any kind of donation, visit Laravel [Patreon page](https://patreon.com/taylorotwell).
