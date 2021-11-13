<?php

namespace App\Contracts;

interface IndicationServiceContract
{
    function getAllIndications(): array;
    function createIndication(array $data);
    function save(array $data);

}
