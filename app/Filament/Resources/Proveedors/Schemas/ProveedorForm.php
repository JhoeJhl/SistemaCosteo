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
                Section::make('Información de Contacto')
                    ->description('Datos personales y de localización del productor.')
                    ->icon('heroicon-m-identification')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre o Razón Social')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user'),

                        TextInput::make('telefono')
                            ->label('Teléfono / WhatsApp')
                            ->tel()
                            ->prefixIcon('heroicon-m-phone'),

                        TextInput::make('direccion')
                            ->label('Dirección Exacta')
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-m-map-pin'),
                    ])
                        
                    ->columns(2)
                    ->columnSpan(['default' => 3, 'lg' => 2]), // Se adapta en celulares, ocupa 2 en PC

                //Datos de operacion de proveedores
                Section::make('Operación')
                    ->description('Condiciones logísticas.')
                    ->icon('heroicon-m-truck')
                    ->schema([
                        TextInput::make('comunidad')
                            ->label('Comunidad')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-map'),

                        Select::make('tipo_terreno')
                            ->label('Tipo de Terreno')
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
                    ->columns(3)
                    ->columnSpan('full')
                 

            ]);
    }
}
