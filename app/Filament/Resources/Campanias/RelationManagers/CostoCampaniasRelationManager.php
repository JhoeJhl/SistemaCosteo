<?php

namespace App\Filament\Resources\Campanias\RelationManagers;

use Filament\Actions\CreateAction as ActionsCreateAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

// Forms
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;

// Tables
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

// Columns
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

// Actions
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

use Filament\Support\Enums\FontWeight;

class CostoCampaniasRelationManager extends RelationManager
{
    protected static string $relationship = 'costoCampanias';

    protected static ?string $title = 'M1 • Costos Fijos e Indirectos';


    public function schema(Schema $schema): Schema
    {
        return $schema
            ->schema([

                Section::make('Información del Costo')
                    ->description('Registro de costos operativos pertenecientes a la campaña.')
                    ->icon('heroicon-m-currency-dollar')
                    ->schema([

                        Grid::make(12)
                            ->schema([

                                ToggleButtons::make('clasificacion')
                                    ->label('Clasificación')
                                    ->options([
                                        'Fijo' => 'Costo Fijo',
                                        'Indirecto' => 'Costo Indirecto',
                                    ])
                                    ->colors([
                                        'Fijo' => 'info',
                                        'Indirecto' => 'warning',
                                    ])
                                    ->icons([
                                        'Fijo' => 'heroicon-m-lock-closed',
                                        'Indirecto' => 'heroicon-m-arrow-path',
                                    ])
                                    ->inline()
                                    ->required()
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                DatePicker::make('fecha_registro')
                                    ->label('Fecha de Registro')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->default(now())
                                    ->required()
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                Select::make('categoria')
                                    ->label('Categoría')
                                    ->options([
                                        'Personal' => 'Personal',
                                        'Servicios' => 'Servicios',
                                        'Certificaciones' => 'Certificaciones',
                                        'Fungibles' => 'Fungibles',
                                        'Administrativo' => 'Administrativo',
                                        'Depreciacion' => 'Depreciación',
                                        'Mantenimiento' => 'Mantenimiento',
                                    ])
                                    ->searchable()
                                    ->native(false)
                                    ->required()
                                    ->prefixIcon('heroicon-m-tag')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                TextInput::make('monto')
                                    ->label('Monto')
                                    ->numeric()
                                    ->prefix('Bs.')
                                    ->placeholder('0.00')
                                    ->required()
                                    ->minValue(0)
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                Textarea::make('descripcion')
                                    ->label('Descripción')
                                    ->placeholder('Ej: Pago de energía eléctrica del mes...')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),

                                ToggleButtons::make('estado_pago')
                                    ->label('Estado de Pago')
                                    ->helperText('Define si el costo ya fue cancelado o continúa pendiente.')
                                    ->options([
                                        'pagado' => 'Pagado',
                                        'pendiente' => 'Pendiente',
                                    ])
                                    ->colors([
                                        'pagado' => 'success',
                                        'pendiente' => 'danger',
                                    ])
                                    ->icons([
                                        'pagado' => 'heroicon-m-check-circle',
                                        'pendiente' => 'heroicon-m-clock',
                                    ])
                                    ->default('pendiente')
                                    ->inline()
                                    ->required()
                                    ->columnSpanFull(),

                            ]),

                    ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('descripcion')

            ->columns([

                TextColumn::make('fecha_registro')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('clasificacion')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Fijo' => 'info',
                        'Indirecto' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('categoria')
                    ->badge()
                    ->searchable()
                    ->weight(FontWeight::SemiBold),

                TextColumn::make('descripcion')
                    ->limit(40)
                    ->searchable()
                    ->tooltip(fn ($record) => $record->descripcion),

                TextColumn::make('monto')
                    ->money('BOB')
                    ->sortable()
                    ->weight(FontWeight::Bold),

                IconColumn::make('estado_pago')
                    ->label('Estado')
                    ->boolean(fn ($state) => $state === 'pagado')
                    ->trueIcon('heroicon-m-check-badge')
                    ->falseIcon('heroicon-m-clock')
                    ->trueColor('success')
                    ->falseColor('danger'),

            ])

            ->filters([

                SelectFilter::make('clasificacion')
                    ->options([
                        'Fijo' => 'Costos Fijos',
                        'Indirecto' => 'Costos Indirectos',
                    ]),

            ])

            ->headerActions([

                CreateAction::make()
                    ->label('Registrar Costo')
                    ->icon('heroicon-m-plus'),

            ])

            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->bulkActions([

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),

            ])

            ->emptyStateHeading('No existen costos registrados')
            ->emptyStateDescription('Registra los costos operativos pertenecientes a esta campaña.')
            ->emptyStateIcon('heroicon-o-banknotes');
    }
}