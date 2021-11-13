<?php

namespace App\Utils;

trait EmailValidation
{
    function getEmailValidation(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }

}
