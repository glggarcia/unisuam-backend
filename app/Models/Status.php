<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";

    public CONST INICIADA = 1;
    public CONST EM_PROCESSO = 2;
    public CONST FINALIZADA = 3;
}
