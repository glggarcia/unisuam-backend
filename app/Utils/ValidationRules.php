<?php

namespace App\Utils;

trait ValidationRules {

    /**
     * @return string[]
     */
    function getValidationRules(): array
    {
        return [
            'cpf' => 'required|unique:indications',
            'email' => 'required'
        ];
    }
}
