<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'tipo_documento',
        'nit_ci',
        'tipo',
        'telefono',
        'direccion',
        'email',
    ];
}