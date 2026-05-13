<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                Select::make('tipo_cliente')
                    ->options(['mayorista' => 'Mayorista', 'minorista' => 'Minorista', 'exportador' => 'Exportador'])
                    ->required(),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('direccion'),
            ]);
    }
}
