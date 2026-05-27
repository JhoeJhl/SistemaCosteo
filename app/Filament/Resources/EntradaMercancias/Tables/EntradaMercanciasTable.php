<?php

namespace App\Filament\Resources\EntradaMercancias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EntradaMercanciasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->recordAction(null)
            ->columns([

                TextColumn::make('fecha_ingreso')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('producto.nombre')
                    ->label('Producto')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('proveedor.nombre')
                    ->label('Proveedor')
                    ->searchable()
                    ->limit(20),

                TextColumn::make('cantidad')
                    ->label('Cantidad')
                    ->numeric(2)
                    ->badge()
                    ->color('info')
                    ->suffix(fn($record) => ' ' . $record->unidad_medida),

                TextColumn::make('costo_unitario')
                    ->label('Costo Unitario')
                    ->money('BOB', true)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('costo_total')
                    ->label('Costo Total')
                    ->money('BOB', true)
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

            ])
            ->searchPlaceholder('Buscar por codigo...')
            ->paginated([10, 25, 50])
            ->emptyStateHeading('No existen Entradas Mercancias')
            ->emptyStateDescription('Crea una entrada para comenzar a administrar.')
            ->emptyStateIcon('heroicon-o-archive-box-arrow-down');
    }
}
