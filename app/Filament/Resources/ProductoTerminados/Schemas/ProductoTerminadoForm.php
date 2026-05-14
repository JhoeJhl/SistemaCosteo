<?php

namespace App\Filament\Resources\ProductoTerminados\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProductoTerminadoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Especificaciones del Producto')
                    ->description('Selecciona la calidad de la pulpa y el formato de empaque.')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('calidad')
                                ->label('Calidad (Sólidos Totales)')
                                ->options([
                                    '18% Sol' => 'Premium (18% Sol)',
                                    '14-17% Sol' => 'Estándar (14-17% Sol)',
                                    '<14% Sol' => 'Baja (<14% Sol)',
                                ])
                                ->native(false)
                                ->required(),

                            Select::make('tamano_empaque_kg')
                                ->label('Tamaño de Empaque')
                                ->options([
                                    '5' => '5 kg (Bolsa Industrial)',
                                    '1' => '1 kg (Bolsa Comercial)',
                                    '0.5' => '0.5 kg (Bolsa Minorista)',
                                ])
                                ->native(false)
                                ->required(),
                        ])
                    ]),
            ]);
    }
}