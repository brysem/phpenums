<?php

namespace Tests;

use Bryse\Enums\Enum;
use Tests\App\Models\User;
use Tests\App\Enums\UserStatus;
use PHPUnit_Framework_TestCase as TestCase;
use Bryse\Enums\Exceptions\UndefinedEnumValueException;

/**
 *  Corresponding Class to test the Enum class.
 *
 *  Applying the Enum class as a value model is a great way
 *  for working with models based on data from a database.
 *
 *  @author Bryse Meijer
 */
class EnumValueModelTest extends TestCase
{
    protected $user;

    public function setUp()
    {
        $this->user = new User(array(
            'status' => new UserStatus(UserStatus::ACTIVE),
        ));
    }

    public function testEnumInstantiation()
    {
        $this->assertTrue($this->user->status instanceof Enum);
    }

    public function testEnumValuesMethod()
    {
        $this->assertTrue(is_array($this->user->status->values()));
    }

    public function testEnumSetMethod()
    {
        $this->user->status->set(UserStatus::ACTIVE);

        $this->assertEquals(UserStatus::ACTIVE, $this->user->status->value());
    }

    public function testEnumGetMethod()
    {
        $this->assertEquals('Active', $this->user->status->get(UserStatus::ACTIVE));
    }

    public function testEnumValueMethod()
    {
        $this->assertEquals(UserStatus::ACTIVE, $this->user->status->value());
    }

    public function testEnumHasMethod()
    {
        $this->assertTrue($this->user->status->has(UserStatus::PENDING));
    }

    public function testEnumIsMethod()
    {
        $this->assertTrue($this->user->status->is(UserStatus::ACTIVE));
    }

    public function testEnumToStringMethod()
    {
        $this->assertEquals('Active', (string) $this->user->status);
    }

    public function testEnumThrowsUndefinedExceptionOnSetAfterExistingValueWasSet()
    {
        try {
            $this->user->status->set(1337);
        } catch (UndefinedEnumValueException $e) {
            $caughtException = true;
        }

        $this->assertTrue(! empty($caughtException));
    }

    public function testEnumDoesNotThrowUndefinedExceptionForExistingValue()
    {
        try {
            $this->user->status->set(UserStatus::PENDING);
        } catch (UndefinedEnumValueException $e) {
            $caughtException = true;
        }

        $this->assertTrue(empty($caughtException));
    }
}
