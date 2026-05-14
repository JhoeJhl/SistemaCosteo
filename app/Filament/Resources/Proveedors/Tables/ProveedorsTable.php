<?php

namespace App\Filament\Resources\Proveedors\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ProveedorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    // Bloque 1: Nombre y Comunidad apilados
                    Stack::make([
                        TextColumn::make('nombre')
                            ->searchable()
                            ->weight('bold')
                            ->size('lg'),
                        TextColumn::make('comunidad')
                            ->icon('heroicon-m-map-pin')
                            ->color('gray')
                            ->searchable(),
                    ]),
                    
                    // Bloque 2: Teléfono
                    TextColumn::make('telefono')
                        ->icon('heroicon-m-phone')
                        ->default('Sin teléfono'),

                    // Bloque 3: Tipo de terreno con distintivo visual (Badge)
                    TextColumn::make('tipo_terreno')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'propio' => 'success',
                            'alquilado' => 'warning',
                            'comunitario' => 'info',
                            default => 'gray',
                        })
                        ->formatStateUsing(fn ($state) => ucfirst($state)),

                    // Bloque 4: Entrega en planta (Icono boolean)
                    IconColumn::make('entrega_en_planta')
                        ->boolean()
                        ->label('Entrega'),
                ])->from('md') // En móviles se apila todo, en PC se divide en columnas
            ])
            // Esto transforma la tabla en tarjetas con fondo
            ->contentGrid([
                'md' => 1,
                'xl' => 2, // En pantallas grandes mostrará 2 proveedores por fila
            ]);
    }
}