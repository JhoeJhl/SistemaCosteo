<?php

namespace App\Filament\Resources\Proveedors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

class ProveedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                        TextInput::make('nombre')
                            ->label('Nombre del Productor')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('comunidad')
                            ->label('Comunidad')
                            ->maxLength(255),
                           
                            
                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel() 
                            ->maxLength(255),
                            
                        TextInput::make('direccion')
                            ->label('Dirección')
                            ->maxLength(255)
                            ->columnSpanFull(), // Hace que la dirección ocupe todo el ancho
            ]);
    }
}