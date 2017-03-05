<?php
namespace cgTag\Enums\Test;

use cgTag\Enums\Enum;
use cgTag\Enums\Test\Mocks\MockBooleanEnum;

class EnumTest extends BaseTestCase
{
    /**
     * @return array
     */
    public function mockBooleanData(): array
    {
        return [
            [MockBooleanEnum::TRUE],
            [MockBooleanEnum::FALSE]
        ];
    }

    /**
     * @return array
     */
    public function mockBooleanValues(): array
    {
        return [
            [1, 'TRUE'],
            [0, 'FALSE']
        ];
    }

    /**
     * @return array
     */
    public function mockInvalidData(): array
    {
        return [
            [''],
            [null],
            [new \stdClass()],
            ['foobar'],
            ['true'],
            ['false'],
            [true],
            [false],
            [null],
            [[1, 2, 3, 4]],
            [[]],
            [function () {

            }]
        ];
    }

    /**
     * @test
     */
    public function shouldBeAbstract()
    {
        $class = new \ReflectionClass(Enum::class);
        $this->assertTrue($class->isAbstract());
    }

    /**
     * @test
     * @param $invalid
     * @dataProvider mockInvalidData
     */
    public function shouldBeInvalid($invalid)
    {
        $this->assertFalse(MockBooleanEnum::isValid($invalid));
    }

    /**
     * @test
     * @dataProvider mockBooleanData
     * @param $value
     */
    public function shouldBeValid($value)
    {
        $this->assertTrue(MockBooleanEnum::isValid($value));
    }

    /**
     * @test
     */
    public function shouldHavePrivateConstructor()
    {
        $class = new \ReflectionClass(Enum::class);
        $con = $class->getConstructor();

        $this->assertNotNull($con);
        $this->assertTrue($con->isPrivate());
    }

    /**
     * @test
     */
    public function shouldNotBeInstantiable()
    {
        $class = new \ReflectionClass(Enum::class);
        $this->assertFalse($class->isInstantiable());
    }

    /**
     * @test
     * @expectedException \cgTag\Enums\Exceptions\EnumException
     * @param mixed $invalid
     * @dataProvider mockInvalidData
     */
    public function shouldNotValidate($invalid)
    {
        MockBooleanEnum::validate($invalid);
    }

    /**
     * @test
     */
    public function shouldToArray()
    {
        $this->assertSame(['TRUE' => 1, 'FALSE' => 0], MockBooleanEnum::toArray());
    }

    /**
     * @test
     */
    public function shouldToOptions()
    {
        $this->assertSame([1 => 'TRUE', 0 => 'FALSE'], MockBooleanEnum::toOptions());
    }

    /**
     * @test
     * @dataProvider mockBooleanValues
     * @param int $value
     * @param string $expected
     */
    public function shouldToString($value, $expected)
    {
        $this->assertSame($expected, MockBooleanEnum::toString($value));
    }

    /**
     * @test
     * @dataProvider mockBooleanValues
     * @param int $value
     * @param string $ignore
     */
    public function shouldValidate($value, $ignore)
    {
        $this->assertSame($value, MockBooleanEnum::validate($value));
    }
}