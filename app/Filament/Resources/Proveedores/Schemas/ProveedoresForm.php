<?php

namespace App\Filament\Resources\Proveedores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProveedoresForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('comunidad'),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('direccion'),
            ]);
    }
}
