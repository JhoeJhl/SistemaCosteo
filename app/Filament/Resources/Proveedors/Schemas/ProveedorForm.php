<?php

namespace App\Filament\Resources\Proveedors\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class ProveedorForm
{
public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([ 
                        
                        // Columna izquierda 
                        Section::make('Información de Contacto')
                            ->schema([ 
                                TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(255),
                                    
                                TextInput::make('telefono')
                                    ->tel()
                                    ->prefixIcon('heroicon-m-phone'),
                                    
                                TextInput::make('direccion')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpan(2),

                        // Columna Derecha 
                        Section::make('Operación')
                            ->schema([ 
                                TextInput::make('comunidad')
                                    ->maxLength(255),

                                Select::make('tipo_terreno')
                                    ->options([
                                        'propio' => 'Propio',
                                        'alquilado' => 'Alquilado',
                                        'comunitario' => 'Comunitario',
                                    ])
                                    ->native(false)
                                    ->required(),

                                Toggle::make('entrega_en_planta')
                                    ->label('¿Entrega en Planta?')
                                    ->onColor('success')
                                    ->inline(false),
                            ])
                            ->columnSpan(1), 
                    ]),

            ]);
    }
}
