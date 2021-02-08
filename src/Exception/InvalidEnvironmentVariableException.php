<?php

declare(strict_types=1);

namespace Ertessia\Env\Exception;

use Exception;

final class InvalidEnvironmentVariableException extends Exception
{
    /**
     * InvalidEnvironmentVariableException constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct('The environment variable: ' . $name . ' should be a string.');
    }
}
