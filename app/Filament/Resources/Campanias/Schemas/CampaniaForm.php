<?php

namespace App\Filament\Resources\Campanias\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CampaniaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                DatePicker::make('fecha_inicio')
                    ->required(),
                DatePicker::make('fecha_fin'),
                Toggle::make('activa')
                    ->required(),
            ]);
    }
}
