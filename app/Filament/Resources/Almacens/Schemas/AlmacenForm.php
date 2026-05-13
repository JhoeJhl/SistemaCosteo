<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AlmacenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                Select::make('tipo')
                    ->options([
            'materia_prima' => 'Materia prima',
            'producto_terminado' => 'Producto terminado',
            'camara_fria' => 'Camara fria',
        ])
                    ->required(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
            ]);
    }
}
