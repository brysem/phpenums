# PHP Enums
[![Latest Stable Version](https://poser.pugx.org/brysem/phpenums/v/stable.png)](https://packagist.org/packages/brysem/phpenums)
[![Total Downloads](https://poser.pugx.org/brysem/phpenums/downloads.png)](https://packagist.org/packages/brysem/phpenums)
[![Build Status](https://travis-ci.org/brysem/phpenums.svg?branch=master)](https://travis-ci.org/brysem/phpenums)
[![codecov](https://codecov.io/gh/brysem/phpenums/branch/master/graph/badge.svg)](https://codecov.io/gh/brysem/phpenums)
[![PHP-Eye](https://php-eye.com/badge/brysem/phpenums/tested.svg)](https://php-eye.com/package/brysem/phpenums)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

Enums made simple in PHP. Providing you with an easy to use interface.

```php
<?php

// Assume that this model will now give us access to the property "status"
// which has been set to an instance of the UserStatus enum class.
$user = new Models\User([
    'status' => new UserStatus(UserStatus::ACTIVE)
]);

echo("Hello, your account is currently ". $user->status ."."); // __toString() -> Hello, your account is currently Active.

// Get all values.
UserStatus::all(); // [1 => 'Pending', 2 => 'Active', 3 => 'Banned']

// Get all keys from the enum.
UserStatus::keys(); // [1, 2, 3]

$userStatus = new UserStatus(UserStatus::ACTIVE);
$userStatus->values();  // [1 => 'Pending', 2 => 'Active', 3 => 'Banned']

// Cast to a string.
(string) $user->status; // Active

// Perform checks
$user->status->is(UserStatus::ACTIVE); // true
$user->status->is([UserStatus::ACTIVE, UserStatus::PENDING]); // true (checkes whether the status is active or pending.)
$user->status->has(UserStatus::PENDING); // true
$user->status->has(1337); // false

// Set and get the value.
$user->status->value(); // 2

$user->status->set(UserStatus::ACTIVE); // Active
$user->status->get(UserStatus::ACTIVE); // Active

// Safegaurding against invalid values
try {
    $user->status->set(1337);
    $user->status->set('undefined');
} catch (UndefinedEnumValueException $e) {
    //
} catch (InvalidArgumentException $e) {
    //
}
```

## Installation
PHP Enums can be installed with [Composer](https://getcomposer.org/).
```bash
$ composer require brysem/phpenums
```

```json
{
    "require": {
        "brysem/phpenums": "1.*"
    }
}
```

```php
<?php

require 'vendor/autoload.php';

use Bryse\Enums\Enum;

class UserStatus extends Enum
{
    const PENDING = 1;
    const ACTIVE = 2;
    const BANNED = 3;

    /**
     * Returns all possible key value pairs for the enum.
     *
     * @return array
     */
    public function values()
    {
        return [
            self::PENDING => 'Pending',
            self::ACTIVE  => 'Active',
            self::BANNED  => 'Banned',
        ];
    }
}
```

## Laravel Example
```php
<?php

namespace App\Models;

use App\Models\Enums\UserType;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function getTypeAttribute()
    {
        return new UserType($this->attributes['type']);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = (new UserType($value))->value();
    }
}
```
You can now easily do the following.

`$user->status = UserType::ACTIVE;`

## Features

* Automatic string casting.
* Useful checks and comparisons.
* Easy to use to any framework or even a plain PHP file.
* PSR-4 autoloading compliant structure.
* Unit-Testing with PHPUnit.

## Contributing

Thank you for considering contributing to PHP Enums. Any and all help is appreciated. Please do not hesitate to send a pull request.

## License

The PHP Enums package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
