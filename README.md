<div align="center">

# PHP wrapper for [Fortnite-API.com](https://fortnite-api.com)

[![GitHub release (latest by date)](https://img.shields.io/github/v/release/Fortnite-API/php-wrapper)](https://github.com/Fortnite-API/php-wrapper/releases) [![Packagist](https://img.shields.io/packagist/dt/michel-pi/fortnite-api)](https://packagist.org/packages/michel-pi/fortnite-api) [![GitHub issues](https://img.shields.io/github/issues/Fortnite-API/php-wrapper)](https://github.com/Fortnite-API/php-wrapper/issues) [![MIT License](https://img.shields.io/github/license/Fortnite-API/php-wrapper)](https://github.com/Fortnite-API/php-wrapper/blob/master/LICENSE)

[![Guzzle HTTP](https://img.shields.io/badge/requires-guzzlehttp%2Fguzzle-blue)](https://github.com/guzzle/guzzle) [![PHP version](https://img.shields.io/packagist/php-v/michel-pi/fortnite-api)](https://www.php.net/)

</div>

This library offers a complete wrapper around the endpoints of [fortnite-api.com](https://fortnite-api.com).

All classes and JSON objects are well documented and support autocompletion and type hints for each object and property.

We also have async requests for each endpoint!

## Composer

    composer require fortnite-api/php-wrapper

## Documentation

Here is a quick overview of the API so you can get started very quickly.

If you need an in-use example then please take a look at the [index.php](https://github.com/Fortnite-API/php-wrapper/blob/master/test/index.php) in my test folder where i use some of the endpoints.

- General usage

```php
use FortniteApi\FortniteApi;

require_once __DIR__ . '/../vendor/autoload.php';

$api = new FortniteApi();
```

- FortniteApi class

```php
$api = new FortniteApi();

// accesses the cosmetics endpoint (https://fortnite-api.com/cosmetics)
$api->cosmetics->...

// accesses the news endpoint (https://fortnite-api.com/news)
$api->news->...

// accesses the shop endpoint (https://fortnite-api.com/shop)
$api->shop->...
```

```php
// returns the base uri of the api (https://fortnite-api.com)
FortniteApi::getBaseUri();

// returns an array of all supported languages
FortniteApi::getSupportedLanguages();
```

- FortniteApiError

```php
$result = $api->cosmetics->getAll();

if ($result === null)
{
    $lastError = FortniteApiError::getLastError();

    // this just shows which members you can access
    $members = [
        $lastError->statusCode,
        $lastError->reasonPhrase,
        $lastError->body,
        $lastError->message
    ];
}
```

```php
// Returns the error set by the last request or false if none is set.
FortniteApiError::getLastError();

// Determines whether an error occured within the last called function.
FortniteApiError::hasLastError();
```

- Async methods

Each method in an endpoint has an equivalent async method (i.e. getAsync) which returns an awaitable task. You can await the response at any point in your script.

```php
// returns "instantly"
$task = $api->cosmetics->getAllAsync();
// retreives the result (the one you get from non-async versions)
$result = $task->await();
```

- Endpoints

Each method in one of the endpoints return `null` on failure.
Autocompletion and type hints are provided on each object.

Objects are mapped with the exact same layout as on [fortnite-api.com/documentation](https://fortnite-api.com/documentation) but without their status and data properties which already get validated for you.

If you need more information about properties and methods then please take a look at the actual implementation.

[Endpoints](https://github.com/Fortnite-API/php-wrapper/tree/master/src/Components/Endpoints)

[JSON Objects](https://github.com/Fortnite-API/php-wrapper/tree/master/src/Components/Objects)

- The `query` parameter

Some methods require a `$query` parameter to work.
You can find possible query parameters within the [official documentation](https://fortnite-api.com/documentation).
An example for such an query `array` would be:

```php
// key value pairs also support arrays as value if the api allows this
$query = [
    "rarity" => "uncommon",
    "hasIcon" => true
];
```

### Contribute

if you can provide any help, may it only be spell checking please contribute!

I am open for any contribution.

## License

- Fortnite-API (MIT) [License](https://github.com/Fortnite-API/php-wrapper/blob/master/LICENSE "MIT License")
- guzzlehttp/guzzle (MIT) [License](https://github.com/guzzle/guzzle/blob/master/LICENSE "MIT License")

API developed by [Fortnite-API.com](https://fortnite-api.com/about)
