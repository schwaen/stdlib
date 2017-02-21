<?php
namespace Schwaen\Common\Utils;

class TestClassA
{
    const MY_CONST = 1;
}

/**
 * ObjectUtilsTest
 */
class ObjectUtilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for Schwaen\Common\Utils\ObjectUtils::getConstants
     */
    public function testGetConstants()
    {
        $this->assertEquals(ObjectUtils::getConstants(new DateTimeUtils), ObjectUtils::getConstants(DateTimeUtils::class));
        $this->assertEquals(['MY_CONST'=>1], ObjectUtils::getConstants(TestClassA::class));
    }
}
