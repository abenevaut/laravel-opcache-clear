# Clear OPcache with ease

This Laravel 5 package allows you to clear OPcache, solving a common problem related to cache invalidation during atomic deployments (also called "zero downtime deploy").

## Getting Started

These instructions allows you to install the package into an existing Laravel app.

### Prerequisities

Laravel 5 up&running installation.


### Installation

You can install this package via Composer using:

```bash
composer require abenevaut/laravel-opcache-clear
```

You must also install this service provider.

```php
// config/app.php
'providers' => [
    ...
    ABENEVAUT\Opcache\Clear\OpcacheClearServiceProvider::class,
    ...
];
```

You must make sure that you've setted the right application url into config/app.php

```php
// config/app.php
 'url' => env('APP_URL', 'http://my-app-url'),
```
### Usage

Once you have installed the package, you can run the following command:

```bash
php artisan opcache:clear
```
All done! Your OPcache is resetted!

### Suggestion

Run this command during deployment process in order to automate the cleaning process before you app become active!
