<?php

namespace App\Filament\Resources\Almacens\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\FontWeight;

class AlmacensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Nombre principal del almacén
                TextColumn::make('nombre')
                    ->label('Almacén')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon(fn ($record) =>
                        $record->tipo === 'MP'
                            ? 'heroicon-m-building-storefront'
                            : 'heroicon-m-cube'
                    )
                    ->iconColor(fn ($record) =>
                        $record->tipo === 'MP'
                            ? 'warning'
                            : 'success'
                    ),

                // Tipo de almacén
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->sortable()
                    ->alignCenter()
                    ->color(fn (string $state): string => match ($state) {
                        'MP' => 'warning',
                        'PT' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'MP' => 'Materia Prima',
                        'PT' => 'Producto Terminado',
                        default => 'Sin tipo',
                    }),

                // Descripción
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(60)
                    ->wrap()
                    ->color('gray')
                    ->default('Sin descripción registrada.'),

                // Fecha de creación
                TextColumn::make('created_at')
                    ->label('Fecha Registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray'),

                // Última actualización
                TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->since()
                    ->sortable()
                    ->icon('heroicon-m-clock')
                    ->color('info'),

            ])

            // Estilo ERP empresarial
            ->striped()

            ->defaultSort('created_at', 'desc')

            ->paginated([10, 25, 50])

            ->emptyStateHeading('No existen almacenes registrados')

            ->emptyStateDescription('Crea un almacén para comenzar a administrar inventario.')

            ->emptyStateIcon('heroicon-o-building-storefront');
    }
}