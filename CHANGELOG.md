# Changelog

All notable changes to `route-usage` will be documented in this file

## 0.3
**29 Oct 2019** | [git diff 0.2..0.3](https://github.com/julienbourdeau/route-usage/compare/0.3..0.3)

* Hide HTML page behind Gate  - PR [#13](https://github.com/julienbourdeau/route-usage/pull/13)

    In your `AuthServicePrivder::boot`, define a gate:
    
    ```php
    Gate::define('viewRouteUsage', function ($user) {
        return $user->isSuperAdmin();
    });
    ```

## 0.2
**28 Oct 2019** | [git diff 0.1..0.2](https://github.com/julienbourdeau/route-usage/compare/0.1..0.2)

* Ignore OPTIONS http calls - PR [#12](https://github.com/julienbourdeau/route-usage/pull/12)

* Ignore routes based on their name or uri - PR [#6](https://github.com/julienbourdeau/route-usage/pull/6)

* Add style for HTML view - PR [#8](https://github.com/julienbourdeau/route-usage/pull/8)

## 0.1 

- initial release
