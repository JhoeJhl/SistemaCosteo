<?php

namespace App\Filament\Resources\Clientes\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ClientesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo')
                    ->label('Clasificación')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'exportador' => 'success', // Verde
                        'mayorista' => 'info',    // Azul
                        'minorista' => 'gray',    // Gris
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('telefono')
                    ->label('Contacto')
                    ->icon('heroicon-m-phone')
                    ->searchable(),

                TextColumn::make('direccion')
                    ->label('Direccion de Entrega')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Correo')
                    ->icon('heroicon-m-envelope')
                    ->toggleable(isToggledHiddenByDefault: true), // Oculto por defecto para limpiar la vista
            ])
            ->defaultSort('nombre', 'asc');
    }
}