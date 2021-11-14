<?php

namespace Indication;

use App\Models\Status;
use TestCase;

class IndicationControllerTest extends TestCase
{
    public function testGetAllIndications()
    {
        $this->json('GET', '/indications')->seeStatusCode(200);
    }

    public function testCreateValid()
    {
        $data = $this->setValidData();
        $this->call('POST', '/indications', $data);

        $this->seeInDatabase('indications', ["cpf" => $data["cpf"]]);
        $this->seeInDatabase('indications', ["email" => $data["email"]]);
        $this->seeInDatabase('indications', ["nome" => $data["nome"]]);
    }

    public function testCreateInvalid()
    {
        $data = $this->setInvalidData();
        $this->call('POST', '/indications', $data)->status(400);

        $response = [
            "mensagem" => "Não foi possível fazer a indicação.",
            "erro" => true,
            "descrição" => [
                "cpf ou email inválido(s)"
            ]
        ];

        $this->json('POST', '/indications', $data)->seeJsonEquals($response);
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

        $this->json('DELETE', '/indications/99')->seeJsonEquals($response);
    }

    public function testDeleteValid()
    {
        $response = [
            "mensagem" => "Indicação deletada",
            "erro" => false,
            "data" => ""
        ];

        $this->call('POST', '/indications', $this->setValidData());
        $this->json('DELETE', '/indications/1')->seeJsonEquals($response);
    }

    public function testUpdateValid()
    {
        $this->call('POST', '/indications', $this->setValidData());

        $this->call('PATCH','/indications/1')->getStatusCode(200);
        $this->seeInDatabase('indications', ['status_id' => Status::EM_PROCESSO]);

        $this->call('PATCH','/indications/1')->getStatusCode(200);
        $this->seeInDatabase('indications', ['status_id' => Status::FINALIZADA]);
    }
    public function testUpdateInvalid()
    {
        $this->call('PATCH','/indications/99', [
            $data['status_id'] = Status::EM_PROCESSO
        ]);

        $response = [
            "mensagem" => "Não foi possível atualizar o status da indicação",
            "erro" => true,
            "descrição" => [
                "Id inválido"
            ]
        ];

        $this->json('PATCH', '/indications/99')->seeJsonEquals($response);
    }





}
