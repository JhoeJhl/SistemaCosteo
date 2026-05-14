<?php

namespace App\Filament\Resources\Proveedors\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Grid;

class ProveedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        // Columna Izquierda (Contacto)
                        Section::make('Información de Contacto')
                            ->schema([
                                TextEntry::make('nombre')
                                    ->label('Nombre del Productor')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('telefono')
                                    ->label('Teléfono')
                                    ->icon('heroicon-m-phone')
                                    ->default('Sin registro'),

                                TextEntry::make('direccion')
                                    ->label('Dirección')
                                    ->columnSpanFull()
                                    ->default('Sin registro'),
                            ])->columns(2)->columnSpan(2),

                        // Columna Derecha (Operación)
                        Section::make('Detalles de Operación')
                            ->schema([
                                TextEntry::make('comunidad')
                                    ->label('Comunidad')
                                    ->icon('heroicon-m-map-pin')
                                    ->default('No registrada'),

                                TextEntry::make('tipo_terreno')
                                    ->label('Tipo de Terreno')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'propio' => 'success',
                                        'alquilado' => 'warning',
                                        'comunitario' => 'info',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn($state) => ucfirst($state)),

                                IconEntry::make('entrega_en_planta')
                                    ->label('¿Entrega en Planta?')
                                    ->boolean(),
                            ])->columnSpan(1),
                    ]),
            ]);
    }
}
