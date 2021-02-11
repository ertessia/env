# Env

This is a small package used to mediate between environment variables and PHP. It's primary use case is to convert raw environment variables to PHP scalar types, which is particularly useful in configuration files.

## Installation

You can install the package via composer:

```bash
composer require ertessia/env
```

## Usage

The `Env::get` method will convert the requested environment variable into the appropriate scalar type.
If the environment variable is not set or if it's not a string it will throw an exception.

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

The `Env::has` method checks whether the requested environment variable is and if it is a string. 
According to the POSIX standards it should always be a string unless it's explicitly set to something else.


```php
$result = \Ertessia\Env\Env::has('ENV_VARIABLE_NAME');
```

If you need to get the raw variant of an environment variable, you can use the `Env::raw` method. 
This method won't cast anything and will always return a string.

```php
$result = \Ertessia\Env\Env::raw('ENV_VARIABLE_NAME');
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