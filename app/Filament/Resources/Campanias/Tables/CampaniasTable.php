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

            //header de la tabla
            ->heading('Gestión de Campañas')
            ->description(
                'Administra campañas de producción y controla módulos operativos y financieros.'
            )

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
                    ->description(
                        fn($record) =>
                        'Inicio: ' . optional($record->fecha_inicio)?->format('d/m/Y')
                    )
                    ->icon('heroicon-m-megaphone')
                    ->iconColor('primary'),

                // Fecha inicio
                TextColumn::make('fecha_inicio')
                    ->label('Inicio')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray'),

                // Fecha fin
                TextColumn::make('fecha_fin')
                    ->label('Finalización')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(
                        fn($state) =>
                        $state
                            ? $state->format('d M Y')
                            : 'En curso'
                    )
                    ->color(
                        fn($state) =>
                        $state ? 'gray' : 'success'
                    ),

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

            ->striped()
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->searchPlaceholder('Buscar campaña por código...')

            // columna de acciones
            ->actions([

                //accion de visualizar datos
                ViewAction::make()
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->tooltip('Ver resumen de campaña')
                    ->iconButton(),

                //accion de editar datos
                EditAction::make()
                    ->icon('heroicon-m-pencil-square')
                    ->color('info')
                    ->tooltip('Editar Informacion')
                    ->iconButton(),

                //accion de costos fijos e indirectos
                Action::make('administrar_costos')
                    ->icon('heroicon-m-banknotes')
                    ->color('success')
                    ->tooltip('Gestion costos fijos e indirectos')
                    ->iconButton()
                    ->url(
                        fn($record) =>
                        CampaniaResource::getUrl(
                            'costos',
                            ['record' => $record]
                        )
                    ),

                //accion de costos variables
                Action::make('administrar_variables')
                    ->icon('heroicon-m-cube-transparent')
                    ->color('warning')
                    ->tooltip('Gestion de costos variables')
                    ->iconButton()
                    ->url(
                        fn($record) =>
                        CampaniaResource::getUrl(
                            'variables',
                            ['record' => $record]
                        )
                    ),

                //accion de eliminar datos
                DeleteAction::make()
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->tooltip('Eliminar campaña')
                    ->iconButton(),

            ])
            ->bulkActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make()
                        ->label('Eliminar seleccionados'),

                ]),

            ])
            
            //Estado vacio de la tabla
            ->emptyStateIcon('heroicon-o-megaphone')
            ->emptyStateHeading('No existen campañas registradas')
            ->emptyStateDescription(
                'Crea una nueva campaña para comenzar la administración operativa.'
            );
    }
}
