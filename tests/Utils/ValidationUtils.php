<?php

namespace Utils;

use App\Utils\CpfValidations;
use App\Utils\EmailValidation;
use App\Utils\ValidationMessages;
use App\Utils\ValidationRules;

class ValidationUtils
{
    use CpfValidations;
    use EmailValidation;
    use ValidationMessages;
    use ValidationRules;
}
