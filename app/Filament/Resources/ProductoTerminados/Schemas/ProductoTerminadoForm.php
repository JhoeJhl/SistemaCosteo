<?php

namespace App\Filament\Resources\ProductoTerminados\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductoTerminadoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                Select::make('calidad')
                    ->options(['premium' => 'Premium', 'estandar' => 'Estandar'])
                    ->required(),
                TextInput::make('tamanio_kg')
                    ->required()
                    ->numeric(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
            ]);
    }
}
