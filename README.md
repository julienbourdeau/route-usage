# Route Usage for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/julienbourdeau/route-usage.svg?style=flat-square)](https://packagist.org/packages/julienbourdeau/route-usage)
[![Build Status](https://img.shields.io/travis/julienbourdeau/route-usage/master.svg?style=flat-square)](https://travis-ci.org/julienbourdeau/route-usage)

This package keeps track of all requests to know what controller method, and when it was called. The goal is not to build some sort of analytics but to find out if there are unused endpoints or controller method.

After a few years, any projects have dead code and unused endpoint. Typically, you removed a link on your frontend, nothing ever links to that old `/special-page`. You want to remove it, but you're not sure.
Have look at the `route_usage` table and figure out when this page was accessed for the last time. Last week? Better keep it for now. 3 years ago? REMOVE THE CODE! 🥳


<img width="984" alt="/route-usage screenshot" src="https://user-images.githubusercontent.com/10015302/67657430-b1cbac00-f991-11e9-92f9-4954d762086f.png">

<img width="1486" alt="php artisan usage:route screenshot" src="https://user-images.githubusercontent.com/1525636/67163336-f9d54800-f36d-11e9-9e23-41bd7f06ca4d.png">

## Installation

You can install the package via composer:

```bash
composer require julienbourdeau/route-usage
```

Run migrations to create the new `route_usage` table.

```bash
php artisan migrate
```

Publish configuration

```bash
php artisan vendor:publish --provider="Julienbourdeau\RouteUsage\RouteUsageServiceProvider"
```

## Usage

To access the route usage, you can do it in your terminal with the command.

```bash
php artisan usage:route
```

To access the HTML table, you'll first need to define who can access it. By default,
it's available only on `local` environment.

In your `AuthServiceProvide`, in the `boot` method, define who can access this page:

```php
Gate::define('viewRouteUsage', function ($user) {
    return $user->isSuperAdmin();
});
```

Then, head over to `yourapp.tld/route-usage`.

## Configuration

### excluding-regex

Here you may specify regex to exclude routes from being logged. 
Typically, you want may want to exclude routes from packages or dev controllers.
The value must be a valid regex or anything falsy.

## Notes

* I only logs request with a 2xx or 3xx HTTP response. I don't think the rest makes sense. Your opinion is welcome!
* In the very first version, I was incrementing a `count` attribute. I removed it because I think it gives a wrong information. If it was used a lot because but last access was a year ago, it gives a false sense of importance to this unused route.

## Todo

- [ ] Add option to put page behind middleware (like `dev` in Laravel Spark)
- [ ] Add support for Redis to log `updated_at`


## About

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email julien@sigerr.org instead of using the issue tracker.

### Credits

- [Julien Bourdeau](https://github.com/julienbourdeau)
- [All Contributors](../../contributors)

### Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
