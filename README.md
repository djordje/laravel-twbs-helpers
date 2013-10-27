## Laravel Twitter Bootstrap Helpers

[![Build Status](https://travis-ci.org/djordje/laravel-twbs-helpers.png?branch=master)](https://travis-ci.org/djordje/laravel-twbs-helpers)

This package aims to provide helpers (html builders) for complex Twitter Bootstrap 3 elements.

For example build menu with properly classed active links...

##### Usage

Currently supported:

* __ListGroup__ (build `.list-group` wrapper with `.list-group-item` child elements) [docs](https://github.com/djordje/laravel-twbs-helpers/blob/master/docs/ListGroup.md)
* __Nav__ (build list of links for `ul.nav`) [docs](https://github.com/djordje/laravel-twbs-helpers/blob/master/docs/NavbarNav.md)

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

Optionally you can add mostly used facades to your application aliases:

```php

# ...

'aliases' => array(
    # ...
    'TwbsNav' => 'Djordje\LaravelTwbsHelpers\Facades\TwbsNav'
),

# ...

```

#### TODO

* Build more helpers
* Write bette documentation

###### Released under MIT licence.