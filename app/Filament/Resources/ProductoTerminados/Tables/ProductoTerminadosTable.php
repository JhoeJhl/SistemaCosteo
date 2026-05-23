<?php

namespace App\Filament\Resources\ProductoTerminados\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProductoTerminadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Columna de calidad
                TextColumn::make('calidad')
                    ->label('Calidad de Pulpa')
                    ->badge() 
                    ->color(fn (string $state): string => match ($state) {
                        '18% Sol' => 'success',    // Verde
                        '14-17% Sol' => 'warning', // Amarillo
                        '<14% Sol' => 'danger',    // Rojo
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                // Columna para el peso con sufijo automático
                TextColumn::make('tamanio_empaque_kg')
                    ->label('Presentación')
                    ->numeric()
                    ->suffix(' kg') // añade al final Kg
                    ->weight('bold')
                    ->sortable(),
            ])
            
            //Estado vacio de la tabla
            ->emptyStateIcon('heroicon-o-cube')
            ->emptyStateHeading('No existen Productos registrados')
            ->emptyStateDescription(
                'Crea un nuevo producto para visualizar los productos del sistema.'
            )
            ->defaultSort('tamanio_empaque_kg', 'desc'); 
    }
}