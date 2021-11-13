<?php

namespace App\Utils;

trait ValidationMessages
{
    /**
     * @return string[]
     */
    function getValidationMessages(): array
    {
        return [
            'required' => 'O :attribute é obrigatório',
            'digits' => 'O :attribute é inválido',
            'unique' => 'Este :attribute já foi utilizado',
        ];
    }
}
