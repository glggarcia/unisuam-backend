<?php

namespace Indication;

use App\Models\Status;
use TestCase;

class IndicationControllerTest extends TestCase
{
    public function testGetAllIndications()
    {
        $this->json('GET', 'api/indications')->seeStatusCode(200);
    }

    public function testCreateValid()
    {
        $data = $this->setValidData();
        $this->call('POST', 'api/indications', $data);

        $this->seeInDatabase('indications', ["cpf" => $data["cpf"]]);
        $this->seeInDatabase('indications', ["email" => $data["email"]]);
        $this->seeInDatabase('indications', ["nome" => $data["nome"]]);
    }

    public function testCreateInvalid()
    {
        $data = $this->setInvalidData();
        $this->call('POST', 'api/indications', $data)->status(400);

        $response = [
            "mensagem" => "Não foi possível fazer a indicação.",
            "erro" => true,
            "descrição" => [
                "cpf ou email inválido(s)"
            ]
        ];

        $this->json('POST', 'api/indications', $data)->seeJsonEquals($response);
    }

    public function testDeleteInvalid()
    {
        $response = [
            "mensagem" => "Não foi possível deletar a indicação.",
            "erro" => true,
            "descrição" => [
                "Id inválido"
            ]
        ];

        $this->json('DELETE', 'api/indications/99')->seeJsonEquals($response);
    }

    public function testDeleteValid()
    {
        $response = [
            "mensagem" => "Indicação deletada",
            "erro" => false,
            "data" => ""
        ];

        $this->call('POST', 'api/indications', $this->setValidData());
        $this->json('DELETE', 'api/indications/1')->seeJsonEquals($response);
    }

    public function testUpdateValid()
    {
        $this->call('POST', 'api/indications', $this->setValidData());

        $this->call('PATCH','api/indications/1')->getStatusCode(200);
        $this->seeInDatabase('indications', ['status_id' => Status::EM_PROCESSO]);

        $this->call('PATCH','api/indications/1')->getStatusCode(200);
        $this->seeInDatabase('indications', ['status_id' => Status::FINALIZADA]);
    }
    public function testUpdateInvalid()
    {
        $this->call('PATCH','api/indications/99', [
            $data['status_id'] = Status::EM_PROCESSO
        ]);

        $response = [
            "mensagem" => "Não foi possível atualizar o status da indicação",
            "erro" => true,
            "descrição" => [
                "Id inválido"
            ]
        ];

        $this->json('PATCH', 'api/indications/99')->seeJsonEquals($response);
    }





}
