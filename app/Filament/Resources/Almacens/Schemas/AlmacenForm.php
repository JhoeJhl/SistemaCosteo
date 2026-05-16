<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AlmacenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registro de Almacén')
                    ->description('Complete la información operativa del almacén.')
                    ->icon('heroicon-m-building-storefront')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre del Almacén')
                            ->required()
                            ->placeholder('Ej. Cámara Fría Norte')
                            ->prefixIcon('heroicon-m-identification'),

                        ToggleButtons::make('tipo')
                            ->label('Tipo de Operación')
                            ->options([
                                'MP' => 'Materia Prima',
                                'PT' => 'Producto Terminado',
                            ])
                            ->icons([
                                'MP' => 'heroicon-m-archive-box',
                                'PT' => 'heroicon-m-cube',
                            ])
                            ->colors([
                                'MP' => 'warning',
                                'PT' => 'info',
                            ])
                            ->inline()
                            ->required(),

                        Textarea::make('descripcion')
                            ->label('Descripción / Ubicación')
                            ->rows(5)
                            ->placeholder(
                                'Ingrese observaciones, ubicación física o capacidad operativa.'
                            ),
                    ])->columnSpan('full'),
            ]);
    }
}