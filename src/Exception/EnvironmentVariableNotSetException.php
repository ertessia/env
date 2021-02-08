<?php

declare(strict_types=1);

namespace Ertessia\Env\Exception;

use Exception;

final class EnvironmentVariableNotSetException extends Exception
{
    /**
     * EnvironmentVariableNotSetException constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct('The environment variable: ' . $name . ' is not set.');
    }
}
