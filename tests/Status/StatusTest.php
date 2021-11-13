<?php

namespace Status;

use App\Models\Status;
use TestCase;

class StatusTest extends TestCase
{
    private CONST INICIADA = "Iniciada";
    private CONST EM_PROCESSO = "Em processo";
    private CONST FINALIZADA = "Finalizada";

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetStatus()
    {
        $status = new Status();

        static::assertEquals(
            self::INICIADA, $status::findOrFail(Status::INICIADA)->description
        );

        static::assertEquals(
            self::EM_PROCESSO, $status::findOrFail(Status::EM_PROCESSO)->description
        );

        static::assertEquals(
            self::FINALIZADA, $status::findOrFail(Status::FINALIZADA)->description
        );
    }
}
