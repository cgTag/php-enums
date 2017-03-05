<?php
namespace cgTag\Enums\Test\TestCase\Exceptions;

use cgTag\Enums\Exceptions\EnumException;
use cgTag\Enums\Test\BaseTestCase;

class EnumExceptionTest extends BaseTestCase
{
    /**
     * @return \Generator
     */
    public function getGenerator()
    {
        yield 1;
    }

    /**
     * @test
     */
    public function shouldShowCallerName()
    {
        $ex = new EnumException('superman', 'FooBar');
        $this->assertSame('"superman" is not a FooBar enum value', $ex->getMessage());
    }

    /**
     * @test
     */
    public function shouldSupportArrays()
    {
        $ex = new EnumException([1, 2, 3, 4], 'FooBar');
        $this->assertSame('<array> is not a FooBar enum value', $ex->getMessage());
    }

    /**
     * @test
     */
    public function shouldSupportCallable()
    {
        $ex = new EnumException(function () {

        }, 'FooBar');
        $this->assertSame('<Closure> is not a FooBar enum value', $ex->getMessage());
    }

    /**
     * @test
     */
    public function shouldSupportGenerator()
    {
        $ex = new EnumException($this->getGenerator(), 'FooBar');
        $this->assertSame('<Generator> is not a FooBar enum value', $ex->getMessage());
    }

    /**
     * @test
     */
    public function shouldSupportLongStrings()
    {
        $ex = new EnumException('This is a very long string value that should be trimmed shorter', 'FooBar');
        $this->assertSame('"This is a very long string value that should be trimmed shor..." is not a FooBar enum value', $ex->getMessage());
    }

    /**
     * @test
     */
    public function shouldSupportObjects()
    {
        $ex = new EnumException(new \stdClass(), 'FooBar');
        $this->assertSame('<stdClass> is not a FooBar enum value', $ex->getMessage());
    }
}