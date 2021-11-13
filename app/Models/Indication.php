<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indication extends Model
{
    protected $fillable = ['nome', 'email', 'cpf', 'telefone', 'status_id'];

}
