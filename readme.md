# Crypton

[![Software License][ico-license]][link-license]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]
[![Quality Score][ico-quality]][link-quality]

This is a simple pakcage for laravel to encrypt decrypt api request & response in both ends, Backend & Javascript.

## Installation

Via Composer

``` bash
$ composer require tzsk/crypton
```

## Configuration

> If you are using `Laravel 5.5` or above you don't need to add the provider and alias.

If you are using `Laravel 5.4` or older add these in the `config/app.php`

```php
'providers' => [
    //...
    'Tzsk\Crypton\CryptonServiceProvider',
],
```

## Environment

Publish the config file by running the following command

```bash
$ php artisan vendor:publish --tag=tzsk-crypton
```

Add an environment veriable in the `.env` file

```env
CRYPTON_KEY=your-encryption-key
```

> **TIP:** You can easily generate an encryption key by running `php artisan key:generate` then copy the generated key. Then again run: `php artisan key:generate` to make the key used by crypton and the default application key different.

**WARNING: DO NOT USE THE SAME `APP_KEY` AND `CRYPTON_KEY`**

## Usage

Start off by adding a Middleware in the `app/Http/Kernel.php` file.

```php
$routeMiddleware = [
    'crypton' => \Tzsk\Crypton\Middlewares\EncryptRequestResponse::class,
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

### Javascript adapter

[See Laravel Crypton](https://github.com/tzsk/laravel-crypton)

For Android & iOS integration packages are coming soon.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email mailtokmahmed@gmail.com instead of using the issue tracker.

## Credits

- [Kazi Mainuddin Ahmed][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/tzsk/crypton.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tzsk/crypton.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/tzsk/crypton/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/167003474/shield
[ico-quality]: https://img.shields.io/scrutinizer/g/tzsk/crypton.svg?style=flat-square

[link-license]: license.md
[link-packagist]: https://packagist.org/packages/tzsk/crypton
[link-downloads]: https://packagist.org/packages/tzsk/crypton
[link-travis]: https://travis-ci.org/tzsk/crypton
[link-styleci]: https://styleci.io/repos/167003474
[link-quality]: https://scrutinizer-ci.com/g/tzsk/crypton

[link-author]: https://github.com/tzsk
[link-contributors]: ../../contributors