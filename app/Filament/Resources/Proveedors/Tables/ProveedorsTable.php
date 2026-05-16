<?php

namespace App\Filament\Resources\Proveedors\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;

class ProveedorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Información principal del proveedor
                TextColumn::make('nombre')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-user-circle')
                    ->iconColor('primary')
                    ->iconPosition(IconPosition::Before)
                    ->description(
                        fn ($record) =>
                        $record->comunidad
                            ? 'Comunidad • ' . $record->comunidad
                            : 'Sin comunidad registrada'
                    )
                    ->wrap(),

                // Contacto
                TextColumn::make('telefono')
                    ->label('Contacto')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->iconColor('success')
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('Teléfono copiado')
                    ->default('No registrado'),

                // Tipo de terreno
                TextColumn::make('tipo_terreno')
                    ->label('Terreno')
                    ->badge()
                    ->sortable()
                    ->alignCenter()
                    ->weight(FontWeight::Medium)
                    ->color(fn (string $state): string => match ($state) {
                        'propio' => 'success',
                        'alquilado' => 'warning',
                        'comunitario' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(
                        fn ($state) => ucfirst($state)
                    ),

                // Entrega en planta
                IconColumn::make('entrega_en_planta')
                    ->label('Entrega')
                    ->boolean()
                    ->sortable()
                    ->alignCenter()
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                // Fecha de registro
                TextColumn::make('created_at')
                    ->label('Registro')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->sinceTooltip()
                    ->icon('heroicon-m-calendar-days')
                    ->iconColor('gray')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Última actualización
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since()
                    ->sortable()
                    ->icon('heroicon-m-clock')
                    ->iconColor('info')
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

         
            ->striped()

            ->defaultSort('created_at', 'desc')

            ->paginated([10, 25, 50])

            // Estado vacío
            ->emptyStateHeading('No existen proveedores registrados')

            ->emptyStateDescription(
                'Registra proveedores para comenzar el control de ingresos de materia prima.'
            )

            ->emptyStateIcon('heroicon-o-truck');
    }
}