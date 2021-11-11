<?php

namespace Validations;

use TestCase;
use Utils\ValidationUtils;

class EmailValidationTest extends TestCase
{
    static $validationUtils;

    public static function setUpBeforeClass(): void
    {
        self::$validationUtils = new ValidationUtils();
    }

    public function testInvalidEmail()
    {
        static::assertFalse(self::$validationUtils->getEmailValidation("test.com"));
        static::assertFalse(self::$validationUtils->getEmailValidation("test@test"));
    }

    public function testValidEmail()
    {
        static::asserttrue(self::$validationUtils->getEmailValidation("test@test.com"));
    }
}
