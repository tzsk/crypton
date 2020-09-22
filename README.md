# :gift: Laravel Crypton

![Crypton Cover Image](resources/crypton.svg)

![GitHub License](https://img.shields.io/github/license/tzsk/crypton?style=for-the-badge)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/tzsk/crypton.svg?style=for-the-badge&logo=composer)](https://packagist.org/packages/tzsk/crypton)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/tzsk/crypton/Tests?label=tests&style=for-the-badge&logo=github)](https://github.com/tzsk/crypton/actions?query=workflow%3ATests+branch%3A4.x)
[![Total Downloads](https://img.shields.io/packagist/dt/tzsk/crypton.svg?style=for-the-badge&logo=laravel)](https://packagist.org/packages/tzsk/crypton)


TThis is a simple package for laravel to encrypt decrypt api request & response in both ends, Backend & Javascript.

## :package: Installation

Via Composer

``` bash
$ composer require tzsk/crypton
```

Publish config file

```bash
$ php artisan crypton:publish
```

Add an environment variable in the `.env` file

```env
CRYPTON_KEY=your-encryption-key
```

## :eyes: Keep in Mind

> **TIP:** You can easily generate an encryption key by running `php artisan key:generate` then copy the generated key. Then again run: `php artisan key:generate` to make the key used by crypton and the default application key different.

**WARNING: DO NOT USE THE SAME `APP_KEY` AND `CRYPTON_KEY`**

## :fire: Usage

Start off by adding a Middleware in the `app/Http/Kernel.php` file.

```php
$routeMiddleware = [
    'crypton' => \Tzsk\Crypton\Middleware\EncryptRequestResponse::class,
];
```

Now, add this middleware to any api routes or groups.

Example:

```php
Route::middleware('crypton')->post('some-endpoint', function(Request $request) {
    return Post::paginate($request->per_page ? : 10);
});
```

That's it.

### :heart_eyes: Javascript adapter

[See Laravel Crypton](https://github.com/tzsk/laravel-crypton)

## :microscope: Testing

``` bash
composer test
```

## :date: Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## :crown: Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## :lock: Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## :heart: Credits

- [Kazi Ahmed](https://github.com/tzsk)
- [All Contributors](../../contributors)

## :policeman: License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
