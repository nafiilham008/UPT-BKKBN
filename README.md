<p align="center">Laravel starter app for UPT BKKBN BANYUMAS.</p>


## Table of Contents
1. [Requirements](#requirements)
2. [What's inside?](#what-inside) 
3. [Features](#features)
4. [Setup](#setup)
5. [Usage](#usage)
6. [License](#license)
7. [Support](#support)

## Requirements
- [PHP ^8.1](https://www.php.net/releases/8.1/en.php)

<h2 id="what-inside">What's inside?</h2>

- [Laravel - ^9.x](https://laravel.com/)
- [Laravel Forify - ^1.x](https://laravel.com/docs/9.x/fortify)
- [Laravel Debugbar - ^3.x](https://github.com/barryvdh/laravel-debugbar)
- [Spatie permission - ^5.x](https://github.com/spatie/laravel-permission)
- [Yajra datatable - ^10.x](https://yajrabox.com/docs/laravel-datatables/master/installation)
- [Intervention Image - ^2.x](https://image.intervention.io/v2)
- [Mazer template - ^2.x](https://github.com/zuramai/mazer/)
- [Generator - ^0.1.x](https://github.com/Zzzul/generator-src/)

## Features
- [x] Authentication ([Laravel Fortify](https://laravel.com/docs/9.x/fortify))
    - Login
    - Register
    - Forgot Password
    - 2FA Authentication
    - Update profile information 
- [x] Roles and permissions ([Spatie Permission](https://spatie.be/docs/laravel-permission/v5/introduction))
- [x] Content Management System All Menu for Admin.

## Setup
1. Clone or download from [Releases](https://github.com/nafiilham008/UPT-BKKBN.git)
```bash
git clone https://github.com/nafiilham008/UPT-BKKBN.git
```

2. CD into `/UPT-BKKBN`
```shell 
cd UPT-BKKBN
```

3. Install Laravel dependency
```shell
composer install
```

4. Create copy of ```.env```
```shell
cp .env.example .env
```

5. Generate laravel key
```shell
php artisan key:generate
```

6. Set database name and account in ```.env```
```shell
DB_DATABASE=bkkbn
DB_USERNAME=root
DB_PASSWORD=
```

7.  Run Laravel migrate and seeder
```shell
php artisan migrate --seed
``` 

8. Create the symbolic link
```shell
php artisan storage:link
``` 

9. Start development server
```shell
php artisan serve
``` 

Account
- Email: admin@example.com
- Password: password

## License
This project has been registered for Intellectual Property Rights (HKI) and can only be used by UPT Balai Diklat KKB Banyumas, with the application number and date: EC00202347371, June 20, 2023.
