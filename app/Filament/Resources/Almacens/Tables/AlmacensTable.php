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

                // 1. NUEVA COLUMNA: Código de Almacén
                TextColumn::make('codigo_almacen')
                    ->label('Código')
                    ->searchable()
                    ->sortable()
                    ->copyable() // Permite copiar el código con un clic
                    ->weight(FontWeight::Bold)
                    ->color('primary'),

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

                // 2. NUEVA COLUMNA: Estado
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge() // Lo mostramos como una etiqueta de color
                    ->searchable()
                    ->sortable()
                    ->alignCenter()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'activo' => 'success',
                        'inactivo' => 'danger',
                        default => 'warning', // Para los estados personalizados ("otro")
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)), // Pone la primera letra en mayúscula

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
                    ->limit(40)
                    ->wrap()
                    ->color('gray')
                    ->default('Sin descripción registrada.'),

                // Fecha de creación
                TextColumn::make('created_at')
                    ->label('Fecha Registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false), // Lo oculta por defecto para no saturar la tabla

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
            
            // --- TRADUCCIONES Y PERSONALIZACIÓN DE LA INTERFAZ ---
            ->searchPlaceholder('Buscar por codigo...')
            ->paginated([10, 25, 50])
            ->emptyStateHeading('No existen almacenes registrados')
            ->emptyStateDescription('Crea un almacén para comenzar a administrar el inventario de la planta.')
            ->emptyStateIcon('heroicon-o-building-storefront');
    }
}