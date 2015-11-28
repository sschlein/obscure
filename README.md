# Obscure
## Why should your users know how much customers you have?

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
[![Build Status](https://travis-ci.org/sschlein/obscure.svg)](https://travis-ci.org/sschlein/obscure)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sschlein/obscure/badges/quality-score.png?b=master&)](https://scrutinizer-ci.com/g/sschlein/obscure/?branch=master)
[![codecov.io](https://codecov.io/github/sschlein/obscure/coverage.svg?branch=master)](https://codecov.io/github/sschlein/obscure?branch=master)
[![StyleCI](https://styleci.io/repos/45939836/shield?style=flat)](https://styleci.io/repos/45939836)

Obscure your Laravel 5 applications IDs from URLs and requests. It's based on the popuplar [Hashids package](https://github.com/ivanakimov/hashids.php)

```php
// http://exampleapplication.com/user/ALnLzW

Route::get('/user/{id}', function ($id) {
    return "ID: " . $id; //returns a number
})->middleware('obscure');
```


## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Optional Configuration](#configuration)
- [License](#license)

<a name="installation" />
## Installation

In order to add obscure to your project, just add

    "sschlein/obscure": "dev-develop"

to your composer.json. Then run `composer install` or `composer update`.

Or run `composer require sschlein/obscure ` if you prefer that.

### Add the service provider to your app

In your `config\app.php` file, add the obscure service provider to `providers` array.

```php
    // ...
    Sschlein\Obscure\ObscureServiceProvider::class,
    // ...
```

Set a salt hash in your `.env` file to generate unique hashs.

```
OBSCURE_SALT=your-unique-phrase
```

### Add the middleware to your Kernel

In your `app\Http\Kernel.php` file, add the obscure middleware to the `$routeMiddleware` array.

```php

protected $routeMiddleware = [
    // ...
    'obscure'         => \Sschlein\Obscure\Middleware\Obscure::class,
    // ...
];

```

<a name="usage" />
## Usage

Obscure looks for routes or request parameters with the name `id`. If this parameter is present, it gets decoded to the id and can be used without applications changes.

```php
// http://exampleapplication.com/obscure/ALnLzW
// hashed with salt "salt"

Route::get('/obscure/{id}', function ($id) {
    return "ID: " . $id; // returns a number
})->middleware('obscure');
```

To generate routes or request parameters, you can use the blade extension. In a blade template, just use

```html
<a href="/users/@obscure(1245)">View User</a>
<input type="hidden" name="id" value="@obscure(1234)">
```

If you need to obscure the id within a controller, use the facade

```php
public function store(...)
{
	return redirect('users/' . Obscure::encode(1234));
}
```

That's it.

<a name="configuration" />
## Optional Configuration

Obscure uses some defaults that can be configured. To change the default configuration, publish the config.

```bash
php artisan vendor:publish
```

You can now configure the `salt` hash, the `length` of the hash and the used `alphabet` of the hash in the `config/obscure.php`.

<a name="license" />
## License

Obscure is free software distributed under the terms of the MIT license.
