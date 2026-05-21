<?php

namespace App\Filament\Resources\Campanias\Tables;

use App\Filament\Resources\Campanias\CampaniaResource;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\FontWeight;

// Acciones
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class CampaniasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Gestión de Campañas')
            ->description('Administra las campañas de producción y controla los costos fijos e indirectos (M1) desde la opción de gestión.')

            ->columns([

                // Código de campaña
                TextColumn::make('codigo_campania')
                    ->label('Código')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::SemiBold),

                // Nombre principal
                TextColumn::make('nombre')
                    ->label('Campaña')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-megaphone')
                    ->iconColor('primary'),

                // Fecha inicio
                TextColumn::make('fecha_inicio')
                    ->label('Inicio')
                    ->date('d M Y')
                    ->sortable()
                    ->icon('heroicon-m-calendar-days')
                    ->iconColor('success'),

                // Fecha fin
                TextColumn::make('fecha_fin')
                    ->label('Finalización')
                    ->formatStateUsing(
                        fn($state) => $state
                            ? $state->format('d M Y')
                            : 'En curso'
                    )
                    ->icon('heroicon-m-calendar-days')
                    ->iconColor('success')
                    ->sortable(),

                // Estado
                IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter(),

            ])

            // Diseño visual
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])

            // Cambiar placeholder del buscador
            ->searchPlaceholder('Buscar por Código...')

            // Acciones modernas sin botón agrupado
            ->actions([

                ViewAction::make()
                    ->label('Ver Resumen')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->tooltip('Visualizar información completa de la campaña')
                    ->iconButton(),

                EditAction::make()
                    ->label('Editar Campaña')
                    ->icon('heroicon-m-currency-dollar')
                    ->color('info')
                    ->tooltip('Edicion de la campaña')
                    ->iconButton(),

                DeleteAction::make()
                    ->label('Eliminar')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->tooltip('Eliminar campaña')
                    ->iconButton(),

                Action::make('administrar_costos')
                    ->label('Centro Financiero')
                    ->icon('heroicon-m-building-library')
                    ->color('success')
                    ->tooltip('Administrar costos fijos e indirectos')
                    ->button()
                    ->outlined()
                    ->extraAttributes([
                        'class' => 'transition-all duration-200 hover:scale-105',
                    ])
                    ->url(
                        fn($record) =>
                        CampaniaResource::getUrl(
                            'costos',
                            ['record' => $record]
                        )
                    ),
            ])

            // Acciones masivas
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            // Estado vacío profesional
            ->emptyStateIcon('heroicon-o-megaphone')
            ->emptyStateHeading('No existen campañas registradas')
            ->emptyStateDescription('Crea una nueva campaña para comenzar a administrar costos y producción.');
    }
}
