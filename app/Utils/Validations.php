<?php

namespace App\Utils;

trait Validations {

    function getCpfValidation(string $cpf): bool
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (preg_match('/(\d)\1{10}/', $cpf) || strlen($cpf) != 11) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    function getEmailValidation(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }

}
