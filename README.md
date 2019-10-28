# Route Usage for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/julienbourdeau/route-usage.svg?style=flat-square)](https://packagist.org/packages/julienbourdeau/route-usage)
[![Build Status](https://img.shields.io/travis/julienbourdeau/route-usage/master.svg?style=flat-square)](https://travis-ci.org/julienbourdeau/route-usage)

This package keeps track of all requests to know what controller method, and when it was called. The goal is not to build some sort of analytics but to find out if there are unused endpoints or controller method.

After a few years, any projects have dead code and unused endpoint. Typically, you removed a link on your frontend, nothing ever links to that old `/special-page`. You want to remove it, but you're not sure.
Have look at the `route_usage` table and figure out when this page was accessed for the last time. Last week? Better keep it for now. 3 years ago? REMOVE THE CODE! 🥳


<img width="984" alt="Screenshot 2019-10-20 at 19 14 39" src="https://user-images.githubusercontent.com/1525636/67163330-e4601e00-f36d-11e9-95f9-0f5f18b158d0.png">

<img width="1486" alt="Screenshot 2019-10-20 at 19 15 19" src="https://user-images.githubusercontent.com/1525636/67163336-f9d54800-f36d-11e9-9e23-41bd7f06ca4d.png">

## Installation

You can install the package via composer:

```bash
composer require julienbourdeau/route-usage
```

Run migrations: 

```bash
php artisan migrate
```


## Usage

Head over to `yourapp.tld/route-usage`. Please note that this page is publicly accessible.


## Notes

* The page showing route usage is **currently publicly available**. (see TODO)
* I only logs request with a 2xx or 3xx HTTP response. I don't think the rest makes sense. Your opinion is welcome!
* In the very first version, I was incrementing a `count` attribute. I removed it because I think it gives a wrong information. If it was used a lot because but last access was a year ago, it gives a false sense of importance to this unused route.
* The HTML page with the table is volontarily not using any CSS: I want it to be very low footprint and as easy as possible to maintain.

## Todo

- [ ] Disable HTML page by default ?
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
