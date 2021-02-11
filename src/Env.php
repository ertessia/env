<?php

declare(strict_types=1);

namespace Ertessia\Env;

use Ertessia\Env\Exception\EnvironmentVariableNotSetException;
use Ertessia\Env\Exception\InvalidEnvironmentVariableException;
use function is_numeric;
use function is_string;
use function strtolower;

final class Env
{
    /**
     * This method performs the actual casting of the requested environment variable. It'll first check and validate
     * the environment variable through the use of the "has" method. If that's okay we'll try to convert it
     * to the appropriate scalar type.
     *
     * If the string is a numeric string, PHP will automatically juggle the type to either an integer or a float
     * by adding 0 to it. When there's no match, we'll just return the string value.
     *
     * @param string $name
     * @return mixed
     * @throws InvalidEnvironmentVariableException
     * @throws EnvironmentVariableNotSetException
     */
    public static function get(string $name): mixed
    {
        if (self::has($name) === false) {
            throw new EnvironmentVariableNotSetException($name);
        }

        if (is_numeric($_ENV[$name]) === true) {
            return $_ENV[$name][0] === '0'
                ? $_ENV[$name]
                : $_ENV[$name] + 0;
        }

        return match (strtolower($_ENV[$name])) {
            'true' => true,
            'false' => false,
            'null' => null,
            default => $_ENV[$name]
        };
    }

    /**
     * Environment variable values should always be a string according to the POSIX standard,
     * therefore we'll throw an exception if the value in $_ENV is anything other than a string. In general this should
     * never happen unless you set it explicitly.
     *
     * If the environment variable does not exist or if it exists but is a string, we'll just return a boolean.
     *
     * @param string $name
     * @return bool
     * @throws InvalidEnvironmentVariableException
     */
    public static function has(string $name): bool
    {
        if (isset($_ENV[$name]) === true && is_string($_ENV[$name]) === false) {
            throw new InvalidEnvironmentVariableException($name);
        }

        return isset($_ENV[$name]);
    }

    /**
     * This method returns the raw value of the environment variable. It'll first check and validate the environment variable
     * through the use of the "has" method.
     *
     * @param string $name
     * @return string
     * @throws EnvironmentVariableNotSetException
     * @throws InvalidEnvironmentVariableException
     */
    public static function raw(string $name): string
    {
        if (self::has($name) === false) {
            throw new EnvironmentVariableNotSetException($name);
        }

        return $_ENV[$name];
    }
}
