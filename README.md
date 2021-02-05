# Env

This is a small package used to mediate between environment variables and PHP. It's primary use case is to convert raw environment variables to PHP scalar types, which is particularly useful in configuration files.

## Installation

You can install the package via composer:

```bash
composer require ertessia/env
```

## Usage

```php
// Based on the value of "ENV_VARIABLE_NAME", this will return the following:
// "true" = true
// "false = false
// "null" = null
// "NULL" = null
// "34" = 34
// "1.123" = 1.123
$result = \Ertessia\Env\Env::get('ENV_VARIABLE_NAME');
```

## Testing

```bash
composer test
```

## Security Vulnerabilities

Please open a new draft security advisory if you've found a security vulnerability.

## Credits

- [Jens de Nies](https://github.com/jensdenies)
- [Jeroen van den Bos](https://github.com/jeroenvdbos)

## License

The MIT License (MIT).