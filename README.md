## Laravel Twitter Bootstrap Helpers

[![Build Status](https://travis-ci.org/djordje/laravel-twbs-helpers.png?branch=master)](https://travis-ci.org/djordje/laravel-twbs-helpers)

This package aims to provide helpers (html builders) for complex Twitter Bootstrap 3 elements.

For example build menu with properly classed active links...

##### Usage

Currently supported:

* [Nav (build list of links for `ul.nav`)](https://github.com/djordje/laravel-twbs-helpers/blob/master/docs/NavbarNav.md)

##### Installation

Recommended installation is trough *composer*, add to your `composer.json`:

```json

"require": {
	"djordje/laravel-twbs-helpers": "dev-master"
}

```

Add service provider to your `app/config/app.php` file:

```php

# ...

'providers' => array(
    # ...
    'Djordje\LaravelTwbsHelpers\LaravelTwbsHelpersServiceProvider',
),

# ...

```

#### TODO

* Build more helpers
* Write bette documentation

###### Released under MIT licence.