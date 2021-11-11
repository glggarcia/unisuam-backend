<?php

namespace Validations;

use TestCase;
use Utils\ValidationUtils;

class CpfValidationTest extends TestCase
{
     static $validationUtils;

     public static function setUpBeforeClass(): void
     {
         self::$validationUtils = new ValidationUtils();
     }

    public function testInvalidCpf()
    {
        static::assertFalse(self::$validationUtils->getCpfValidation("12312312421"));
    }

    public function testCpfWithRepeatedDigits()
    {
        static::assertFalse(self::$validationUtils->getCpfValidation("99999999999"));
    }

    public function testCpfLessThan11Digits()
    {
        static::assertFalse(self::$validationUtils->getCpfValidation("625583871"));
    }

    public function testValidCpf()
    {
        static::assertTrue(self::$validationUtils->getCpfValidation("62558387146"));
    }
}
