<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    /**
     * @return string[]
     */
    protected function setValidData(): array
    {
        return [
            'nome' => "Test",
            "email" => "test@test.com",
            "telefone" => "",
            "cpf" => "97537727007"
        ];
    }

    /**
     * @return string[]
     */
    protected function setInvalidData(): array
    {
        return [
            'nome' => "Test",
            "email" => "test@test",
            "telefone" => "",
            "cpf" => "3015114905"
        ];
    }
}
