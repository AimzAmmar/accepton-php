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

## Getting Started

This library uses the [HTTPlug][httplug] interface to abstract the specific
HTTP client and [PSR-7][psr7] message factory used in the client. If you do not
already have an HTTPlug-compatible client and PSR-7 message factory installed,
you will need to install one.

Your `HTTPClient` and `MessageFactory` can then be auto-discovered using
[Puli][puli].

See the [list of HTTP clients][httpclients]  to choose from. Also, the HTTPlug
project has [quick start instructions][clients] for a number of the clients.

### Using Service Discovery

As a quick start, you can install these packages via composer, which will give
you the following:

1. A [Guzzle][guzzle]-based HTTP client.
2. A PHP-HTTP Guzzle message factory.
3. Puli for auto-discovery.

```sh
$ composer require \
    php-http/guzzle6-adapter \
    php-http/message \
    puli/composer-plugin \
    puli/repository \
    puli/discovery
```

Then, initialize the client like so:

```php
use AcceptOn\Client;

$client = new Client(API_KEY, "staging");
```

### Without Service Discovery

If you prefer not to use Puli, you can install one of [HTTP clients][clients]
and accompanying message factories using Composer. For example, if you want to
use Guzzle6, run:

```sh
$ composer require php-http/guzzle6-adapter php-http/message
```

The `php-http/guzzle6-adapter` contains the HTTPlug client and
`php-http/message` contains the message factory.

Then, initialize the client like so:

```php
use AcceptOn\Client;
use Http\Adapter\Guzzle6\Client as HttpClient;
use Http\Message\MessageFactory\GuzzleMessageFactory as MessageFactory;

$httpClient = new HttpClient();
$messageFactory = new MessageFactory();

$client = new Client(API_KEY, "staging");
$client->setHttpClient($httpClient);
$client->setMessageFactory($messageFactory);
```

[autoload]: https://getcomposer.org/doc/01-basic-usage.md#autoloading
[clients]: http://php-http.org/en/latest/clients.html
[composer]: https://getcomposer.org
[guzzle]: http://guzzlephp.org
[httpclients]: https://packagist.org/providers/php-http/client-implementation
[httplug]: http://php-http.org
[puli]: http://puli.io
[psr7]: http://www.php-fig.org/psr/psr-7/

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Write your code *and unit tests*
4. Ensure all tests still pass (`bundle exec rspec`)
5. Commit your changes (`git commit -am 'Add some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create a new pull request
