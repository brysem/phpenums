<?php

namespace Tests;

use Bryse\Enums\Enum;
use Tests\App\Enums\PostStatus;
use Tests\App\Enums\UserStatus;
use PHPUnit_Framework_TestCase as TestCase;
use Bryse\Enums\Exceptions\UndefinedEnumValueException;

/**
 *  Corresponding Class to test the Enum class.
 *
 *  All methods defined in the EnumContract interface must be tested.
 *
 *  @author Bryse Meijer
 */
class EnumBasicTest extends TestCase
{
    public function testEnumInstantiation()
    {
        $status = new UserStatus();

        $this->assertTrue($status instanceof Enum);
    }

    public function testEnumAllMethod()
    {
        $this->assertTrue(is_array(UserStatus::all()));
    }

    public function testEnumValuesMethod()
    {
        $status = new UserStatus();

        $this->assertTrue(is_array($status->values()));
    }

    public function testEnumSetMethod()
    {
        $status = new UserStatus();
        $status->set(UserStatus::ACTIVE);

        $this->assertEquals(UserStatus::ACTIVE, $status->value());
    }

    public function testEnumGetMethod()
    {
        $status = new UserStatus();

        $this->assertEquals('Active', $status->get(UserStatus::ACTIVE));
    }

    public function testEnumValueMethod()
    {
        $status = new UserStatus(UserStatus::BANNED);

        $this->assertEquals(UserStatus::BANNED, $status->value());
    }

    public function testEnumHasMethod()
    {
        $status = new UserStatus();

        $this->assertTrue($status->has(UserStatus::PENDING));
    }

    public function testEnumIsMethod()
    {
        $status = new UserStatus(UserStatus::PENDING);

        $this->assertTrue($status->is(UserStatus::PENDING));
    }

    public function testEnumToStringMethod()
    {
        $status = new UserStatus(UserStatus::PENDING);

        $this->assertEquals('Pending', (string) $status);
    }

    public function testEnumThrowsUndefinedException()
    {
        try {
            new UserStatus(1337);
        } catch (UndefinedEnumValueException $e) {
            //
        }

        $this->assertTrue(! empty($e));
    }

    public function testEnumThrowsUndefinedExceptionOnSetAfterExistingValueWasSet()
    {
        $status = new UserStatus(UserStatus::ACTIVE);

        try {
            $status->set(1337);
        } catch (UndefinedEnumValueException $e) {
            //
        }

        $this->assertTrue(! empty($e));
    }

    public function testEnumDoesNotThrowUndefinedExceptionForExistingValue()
    {
        $status = new UserStatus(UserStatus::ACTIVE);

        try {
            $status->set(UserStatus::PENDING);
        } catch (UndefinedEnumValueException $e) {
            //
        }

        $this->assertTrue(empty($e));
    }

    public function testUndefinedEnumValueExceptionValueMethod()
    {
        $status = new UserStatus(UserStatus::ACTIVE);

        try {
            $status->set(1337);
        } catch (UndefinedEnumValueException $e) {
            $this->assertEquals(1337, $e->value());
        }

        if (empty($e)) {
            $this->fail('UndefinedEnumValueException was not thrown but expected.');
        }
    }

    public function testEnumThrowsUndefinedEnumValueExceptionForExistingValue()
    {
        $status = new UserStatus(UserStatus::ACTIVE);

        try {
            $status->set('undefined');
        } catch (UndefinedEnumValueException $e) {
            //
        }

        $this->assertTrue(! empty($e));
    }

    public function testEnumThrowsUndefinedEnumValueExceptionForGet()
    {
        $status = new UserStatus(UserStatus::ACTIVE);

        try {
            $status->get('undefined');
        } catch (UndefinedEnumValueException $e) {
            //
        }

        $this->assertTrue(! empty($e));
    }

    public function testEnumArrayValueEncodesToJson()
    {
        $status = new UserStatus(UserStatus::MIXED);

        $this->assertInternalType('string', (string) $status);
    }

    public function testEnumStringValueIsValid()
    {
        $status = new PostStatus(PostStatus::UNPUBLISHED);

        $this->assertEquals('Unpublished Post', (string) $status);
    }

    public function testEnumStringValueIsMethod()
    {
        $status = new PostStatus(PostStatus::ARCHIVED);

        $this->assertTrue($status->is(PostStatus::ARCHIVED));
    }

    public function testEnumJsonEncode()
    {
        $status = new PostStatus(PostStatus::ARCHIVED);

        $this->assertEquals(json_encode($status), '"'. PostStatus::ARCHIVED. '"');
    }
}
