<?php

namespace App\Utils;

trait EmailValidation
{
    /**
     * @param string $email
     * @return bool
     */
    function getEmailValidation(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }

}
