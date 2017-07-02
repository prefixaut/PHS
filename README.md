# PHS - Preprocessed Hyper Speedruns
> A PHP Wrapper for the [@speedruncom api](https://github.com/speedruncom/api)

## Installation
### Composer
Best way to use it is via composer since it already handles the autoloading.

```bash
composer require prefixaut/phs
```

### Git
Clone the repo and setup the autoloading manually

## Usage

### Authentification
```php
// Without Authentification
$src = new PHS\v1\API();

// With Authentification
$src = new PHS\v1\API('API_TOKEN');

// The token can also be provided later on
$src->setAuth('API_TOKEN');
```

```
$src->engines->all([
    'order' => "...",
    // ... Other settings
]);

$src->users->get('USER');
```

## License
This Project is licensed under the MIT License. Read more in the `LICENSE` file
