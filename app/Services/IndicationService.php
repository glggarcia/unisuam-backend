<?php

namespace App\Services;

use App\Contracts\IndicationServiceContract;
use App\Models\Indication;
use App\Models\Status;
use App\Utils\CpfValidations;
use App\Utils\EmailValidation;
use App\Utils\ValidationMessages;
use App\Utils\ValidationRules;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\throwException;

class IndicationService extends BaseService implements IndicationServiceContract
{
    use CpfValidations;
    use EmailValidation;
    use ValidationRules;
    use ValidationMessages;

    private $indication;

    public function __construct(Indication $indication)
    {
        $this->indication = $indication;
    }

    /**
     * @return array
     */
    public function getAllIndications(): array
    {
        return [
            'indications' => $this->indication::all()
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createIndication(array $data)
    {
        $validation = $this->validator($data);
        if(!$validation) {
            $this->setErrors([
                "cpf ou email inválido(s)"
            ]);
            return null;
        }

        if($validation->fails()) {
            $this->setErrors($validation->errors()->getMessageBag());
            return null;
        }

        return $this->save($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return Indication::create([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'status_id' => Status::INICIADA
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function validator(array $data)
    {
        if(!isset($data['cpf']) && !isset($data['email'])) {
            return null;
        }
        if($this->getCpfValidation($data['cpf']) && $this->getEmailValidation($data['email'])) {
            return Validator::make($data, $this->getValidationRules(), $this->getValidationMessages());
        }

        return null;
    }

}
