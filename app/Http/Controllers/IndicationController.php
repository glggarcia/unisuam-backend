<?php

namespace App\Http\Controllers;

use App\Models\Indication;
use App\Services\IndicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndicationController extends Controller
{
    private $indicationService;

    public function __construct()
    {
        $this->indicationService = new IndicationService(new Indication());
    }

    /**
     * @return JsonResponse|null
     */
    public function getAll(): ?JsonResponse
    {
        $result = $this->indicationService->getAllIndications();
        return $this->successResponse('Lista de todas as Indicações', $result);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $result = $this->indicationService->createIndication($data);

        if(!$result) {
            return $this->errorResponse('Não foi possível fazer a indicação.',
                $this->indicationService->getErrors());
        }

        return $this->successResponse('Indicação feita com sucesso', $result);
    }

    public function delete(int $id)
    {
        $result = $this->indicationService->delete($id);

        if(!$result) {
            return $this->errorResponse('Não foi possível deletar a indicação.',
                $this->indicationService->getErrors());
        }
        return $this->successResponse('Indicação deletada', '');
    }

    public function update(int $id)
    {
        $result = $this->indicationService->updateIndicationStatus($id);

        if(!$result) {
            return $this->errorResponse('Não foi possível atualizar o status da indicação',
                $this->indicationService->getErrors());
        }
        return $this->successResponse('Status da indicação atualizado', $result);
    }
}
