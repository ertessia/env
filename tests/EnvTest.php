<?php

declare(strict_types=1);

namespace Ertessia\Env\Tests;

use Ertessia\Env\Env;
use Ertessia\Env\Exception\EnvironmentVariableNotSetException;
use Ertessia\Env\Exception\InvalidEnvironmentVariableException;
use PHPUnit\Framework\TestCase;

final class EnvTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     * @throws EnvironmentVariableNotSetException
     */
    public function test_if_environment_variable_is_correctly_converted_in_the_get_method(): void
    {
        $_ENV['LOWER_CASE_NULL'] = 'null';
        $_ENV['UPPER_CASE_NULL'] = 'NULL';
        $_ENV['BOOLEAN_FALSE'] = 'false';
        $_ENV['BOOLEAN_TRUE'] = 'true';
        $_ENV['UPPER_CASE_STRING'] = 'TEST';
        $_ENV['LOWER_CASE_STRING'] = 'another test';
        $_ENV['INTEGER'] = '2';
        $_ENV['FLOAT'] = '3.9';
        $_ENV['NUMERIC_STRING_WITH_LEADING_ZERO'] = '01234';

        $this->assertSame(null, Env::get('LOWER_CASE_NULL'));
        $this->assertSame(null, Env::get('UPPER_CASE_NULL'));
        $this->assertSame(false, Env::get('BOOLEAN_FALSE'));
        $this->assertSame(true, Env::get('BOOLEAN_TRUE'));
        $this->assertSame('TEST', Env::get('UPPER_CASE_STRING'));
        $this->assertSame('another test', Env::get('LOWER_CASE_STRING'));
        $this->assertSame(2, Env::get('INTEGER'));
        $this->assertSame(3.9, Env::get('FLOAT'));
        $this->assertSame('01234', Env::get('NUMERIC_STRING_WITH_LEADING_ZERO'));
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     */
    public function test_if_has_method_returns_false_when_the_environment_variable_exists(): void
    {
        $this->assertEquals(false, Env::has('DOES_NOT_EXIST'));
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     */
    public function test_if_has_method_returns_true_when_the_environment_variable_exists_and_is_a_string(): void
    {
        $_ENV['DOES_EXIST'] = 'test';

        $this->assertEquals(true, Env::has('DOES_EXIST'));
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     * @throws EnvironmentVariableNotSetException
     */
    public function test_if_exception_is_thrown_when_the_environment_variable_does_not_exist(): void
    {
        $this->expectException(EnvironmentVariableNotSetException::class);

        Env::get('UNKNOWN');
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     * @throws EnvironmentVariableNotSetException
     */
    public function test_if_exception_is_thrown_when_the_environment_variable_is_not_a_string_in_the_get_method(): void
    {
        $this->expectException(InvalidEnvironmentVariableException::class);

        $_ENV['NOT_A_STRING'] = 78;

        Env::get('NOT_A_STRING');
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     */
    public function test_if_exception_is_thrown_when_the_environment_variable_is_not_a_string_in_the_has_method(): void
    {
        $this->expectException(InvalidEnvironmentVariableException::class);

        $_ENV['NOT_A_STRING'] = 78;

        Env::has('NOT_A_STRING');
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     * @throws EnvironmentVariableNotSetException
     */
    public function test_if_environment_variable_is_correctly_returned_in_the_raw_method(): void
    {
        $_ENV['LOWER_CASE_NULL'] = 'null';
        $_ENV['UPPER_CASE_NULL'] = 'NULL';
        $_ENV['BOOLEAN_FALSE'] = 'false';
        $_ENV['BOOLEAN_TRUE'] = 'true';
        $_ENV['UPPER_CASE_STRING'] = 'TEST';
        $_ENV['LOWER_CASE_STRING'] = 'another test';
        $_ENV['INTEGER'] = '2';
        $_ENV['FLOAT'] = '3.9';

        $this->assertSame('null', Env::raw('LOWER_CASE_NULL'));
        $this->assertSame('NULL', Env::raw('UPPER_CASE_NULL'));
        $this->assertSame('false', Env::raw('BOOLEAN_FALSE'));
        $this->assertSame('true', Env::raw('BOOLEAN_TRUE'));
        $this->assertSame('TEST', Env::raw('UPPER_CASE_STRING'));
        $this->assertSame('another test', Env::raw('LOWER_CASE_STRING'));
        $this->assertSame('2', Env::raw('INTEGER'));
        $this->assertSame('3.9', Env::raw('FLOAT'));
    }

    /**
     * @return void
     * @throws InvalidEnvironmentVariableException
     * @throws EnvironmentVariableNotSetException
     */
    public function test_if_exception_is_thrown_when_the_environment_variable_does_not_exist_in_the_raw_method(): void
    {
        $this->expectException(EnvironmentVariableNotSetException::class);

        Env::raw('UNKNOWN');
    }

    /**
     * @return void
     * @throws EnvironmentVariableNotSetException
     * @throws InvalidEnvironmentVariableException
     */
    public function test_if_exception_is_thrown_when_the_environment_variable_is_not_a_string_in_the_raw_method(): void
    {
        $this->expectException(InvalidEnvironmentVariableException::class);

        $_ENV['NOT_A_STRING'] = 78;

        Env::raw('NOT_A_STRING');
    }
}
