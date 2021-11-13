<?php

namespace Indication;

use App\Contracts\IndicationServiceContract;
use App\Models\Indication;
use App\Models\Status;
use App\Services\IndicationService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use TestCase;
use function PHPUnit\Framework\assertEquals;

class IndicationServiceTest extends TestCase
{
    private static $indicationService;

    public static function setUpBeforeClass(): void
    {
        self::$indicationService = new IndicationService(new Indication());
    }

    public function testClassInstance()
    {
        static::assertInstanceOf(IndicationServiceContract::class, self::$indicationService);
    }

    public function testGetAllIndicationsEmpty()
    {
        static::json('GET', '/indications')->seeJson([
            "mensagem" => "Lista de todas as Indicações",
            "erros" => false
        ]);
    }

    public function testCreateIndication()
    {
        $result = self::$indicationService->createIndication($this->setValidData());
        $indication = Indication::find($result->id);

        static::assertEquals($result->nome, $indication->nome);
        static::assertEquals($result->cpf, $indication->cpf);
        static::assertEquals($result->email, $indication->email);
    }

    public function testCreateIndicationInvalid()
    {
        static::assertNull(self::$indicationService->createIndication($this->setInvalidData()));
    }

    public function testCreateIndicationValidatorCpfFail()
    {
        self::$indicationService->createIndication($this->setValidData());
        $data = [
            'nome' => "Test2",
            "email" => "test@test.com",
            "telefone" => "",
            "cpf" => "97537727007"
        ];
        self::$indicationService->createIndication($data);
        $json = json_encode(["cpf" => "Este cpf já foi utilizado"]);

        static::assertNull(self::$indicationService->createIndication($data));
        static::assertJson($json, self::$indicationService->getErrors()) ;
    }

    public function testCreateIndicationValidatorEmailFail()
    {
        self::$indicationService->createIndication($this->setValidData());
        $data = [
            'nome' => "Test2",
            "email" => "",
            "telefone" => "",
            "cpf" => "38522663009"
        ];
        static::assertNull(self::$indicationService->createIndication($data));
    }

    public function testDeleteIdInvalid()
    {
        self::$indicationService->delete(10);
        static::assertEquals("Id inválido", self::$indicationService->getErrors()[0]);
    }

    public function testDeleteValid()
    {
        $result = self::$indicationService->createIndication($this->setValidData());
        static::assertTrue(self::$indicationService->delete($result->id));
    }

    public function testDeleteInProgress()
    {
        $data =  [
            'nome' => "Test",
            "email" => "test@test.com",
            "telefone" => "",
            "cpf" => "66526604072",
            "status_id" => Status::EM_PROCESSO
        ];

        $result = self::$indicationService->createIndication($data);
        self::$indicationService->delete($result->id);

        static::assertEquals("Indicação em processo, não foi possível deletar",
            self::$indicationService->getErrors()[0]);
    }

    /**
     * @return string[]
     */
    private function setValidData(): array
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
    private function setInvalidData(): array
    {
        return [
            'nome' => "Test",
            "email" => "test@test",
            "telefone" => "",
            "cpf" => "3015114905"
        ];
    }
}
