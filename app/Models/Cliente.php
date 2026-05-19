<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'nit_ci',
        'tipo',
        'telefono',
        'direccion',
        'email',
    ];
}