# AcceptOn

[![Build Status](https://circleci.com/gh/accepton/accepton-php.svg?style=shield&circle-token=76d9d3cf6e881e7a80b22cc68c223725ade7fa31)](https://circleci.com/gh/accepton/accepton-php)

## Documentation

Please see the [PHP developer documentation][phpdocs] for more information.

[phpdocs]: http://developers.accepton.com/?php

## Installation

You can install the package via [Composer][composer]:

```sh
$ composer require accepton/accepton
```

And then use Composer's [autoload][autoload] to require it:

```php
require_once("vendor/autoload.php");
```

Then, initialize the client like so:

```php
use AcceptOn\Client;

$client = new Client(API_KEY, "staging");
```

This library uses the [HTTPlug][httplug] interface to abstract the specific
HTTP connection method used in the client. If you do not already have an
HTTPlug-compatible client installed, you will need to install one.

[composer]: https://getcomposer.org
[autoload]: https://getcomposer.org/doc/01-basic-usage.md#autoloading
[httplug]: http://php-http.org

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Write your code *and unit tests*
4. Ensure all tests still pass (`bundle exec rspec`)
5. Commit your changes (`git commit -am 'Add some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create a new pull request
