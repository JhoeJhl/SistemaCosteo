<?php

namespace App\Filament\Resources\Campanias\Pages;

use BackedEnum;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Support\Enums\FontWeight;
use Filament\Resources\Pages\ManageRelatedRecords;

use App\Filament\Resources\Campanias\CampaniaResource;
use App\Filament\Resources\Campanias\Widgets\CostoCampaniaStats;

// componentes schema
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

// componentes form
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;

// tablas
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ManageCostoCampania extends ManageRelatedRecords
{
    protected static string $resource = CampaniaResource::class;

    protected static string $relationship = 'costoCampanias';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    /*
    |--------------------------------------------------------------------------
    | HEADER ERP
    |--------------------------------------------------------------------------
    */

    public function getTitle(): string
    {
        return 'Centro Financiero';
    }

    public function getHeading(): string
    {
        return 'Administración de Costos Operativos';
    }

    public function getSubheading(): ?string
    {
        return 'Campaña: ' . $this->getOwnerRecord()->nombre;
    }

    public function getBreadcrumb(): string
    {
        return 'Gestión Financiera';
    }

    /*
    |--------------------------------------------------------------------------
    | KPIs
    |--------------------------------------------------------------------------
    */

    protected function getHeaderWidgets(): array
    {
        return [
            CostoCampaniaStats::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | HEADER ACTIONS
    |--------------------------------------------------------------------------
    */

    protected function getHeaderActions(): array
    {
        return [

            CreateAction::make()
                ->label('Registrar Nuevo Costo')
                ->icon('heroicon-m-plus-circle')
                ->color('success')
                ->slideOver()
                ->modalHeading('Registrar Costo Operativo')
                ->modalDescription('Complete la información financiera correspondiente.'),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FORM FILAMENT V4
    |--------------------------------------------------------------------------
    */

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make(12)
                    ->schema([

                        Section::make('Información Financiera')
                            ->description('Registro detallado del costo operativo.')
                            ->icon('heroicon-m-banknotes')
                            ->compact()
                            ->columns(12)
                            ->schema([

                                /*
                                |--------------------------------------------------------------------------
                                | TIPO COSTO
                                |--------------------------------------------------------------------------
                                */

                                ToggleButtons::make('clasificacion')
                                    ->label('Tipo de Costo')
                                    ->options([
                                        'Fijo' => 'Costo Fijo',
                                        'Indirecto' => 'Costo Indirecto',
                                    ])
                                    ->colors([
                                        'Fijo' => 'info',
                                        'Indirecto' => 'warning',
                                    ])
                                    ->inline()
                                    ->grouped()
                                    ->required()
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                /*
                                |--------------------------------------------------------------------------
                                | FECHA
                                |--------------------------------------------------------------------------
                                */

                                DatePicker::make('fecha_registro')
                                    ->label('Fecha del Gasto')
                                    ->default(now())
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->required()
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                /*
                                |--------------------------------------------------------------------------
                                | CATEGORIA
                                |--------------------------------------------------------------------------
                                */

                                Select::make('categoria')
                                    ->label('Categoría Financiera')
                                    ->options([
                                        'Personal' => 'Personal',
                                        'Servicios' => 'Servicios',
                                        'Certificaciones' => 'Certificaciones',
                                        'Fungibles' => 'Fungibles',
                                        'Administrativo' => 'Administrativo',
                                        'Depreciación' => 'Depreciación',
                                        'Mantenimiento' => 'Mantenimiento',
                                    ])
                                    ->searchable()
                                    ->preload()
                                    ->native(false)
                                    ->required()
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                /*
                                |--------------------------------------------------------------------------
                                | MONTO
                                |--------------------------------------------------------------------------
                                */

                                TextInput::make('monto')
                                    ->label('Monto Registrado')
                                    ->numeric()
                                    ->prefix('Bs.')
                                    ->required()
                                    ->minValue(0)
                                    ->placeholder('0.00')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                    ]),

                                /*
                                |--------------------------------------------------------------------------
                                | DESCRIPCION
                                |--------------------------------------------------------------------------
                                */

                                Textarea::make('descripcion')
                                    ->label('Descripción del Costo')
                                    ->rows(4)
                                    ->autosize()
                                    ->placeholder('Detalle completo del gasto operativo...')
                                    ->required()
                                    ->columnSpan('full'),

                                /*
                                |--------------------------------------------------------------------------
                                | ESTADO PAGO
                                |--------------------------------------------------------------------------
                                */

                                ToggleButtons::make('esta_pagado')
                                    ->label('Estado del Pago')
                                    ->options([
                                        1 => 'Pagado',
                                        0 => 'Pendiente',
                                    ])
                                    ->colors([
                                        1 => 'success',
                                        0 => 'warning',
                                    ])
                                    ->icons([
                                        1 => 'heroicon-m-check-circle',
                                        0 => 'heroicon-m-clock',
                                    ])
                                    ->inline()
                                    ->grouped()
                                    ->default(0)
                                    ->required()
                                    ->columnSpan('full'),

                            ])
                            ->columnSpan('full'),

                    ])
                    ->columnSpan('full'),

            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLE ERP
    |--------------------------------------------------------------------------
    */

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('descripcion')

            ->striped()

            ->defaultSort('fecha_registro', 'desc')

            ->columns([

                TextColumn::make('fecha_registro')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray'),

                TextColumn::make('clasificacion')
                    ->label('Tipo')
                    ->badge()
                    ->sortable()
                    ->icon('heroicon-m-tag')
                    ->color(
                        fn ($state) =>
                        $state === 'Fijo'
                            ? 'info'
                            : 'warning'
                    ),

                TextColumn::make('categoria')
                    ->label('Categoría')
                    ->badge()
                    ->searchable()
                    ->color('gray'),

                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->searchable()
                    ->limit(45)
                    ->tooltip(fn ($record) => $record->descripcion)
                    ->weight(FontWeight::SemiBold),

                TextColumn::make('monto')
                    ->label('Monto')
                    ->money('BOB', true)
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->color('success')
                    ->alignEnd(),

                IconColumn::make('esta_pagado')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->alignCenter(),

            ])

            /*
            |--------------------------------------------------------------------------
            | ACTIONS
            |--------------------------------------------------------------------------
            */

            ->actions([

                EditAction::make()
                    ->label('Editar')
                    ->icon('heroicon-m-pencil-square')
                    ->color('info')
                    ->tooltip('Modificar costo')
                    ->slideOver()
                    ->iconButton(),

                DeleteAction::make()
                    ->label('Eliminar')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->tooltip('Eliminar costo')
                    ->iconButton(),

            ])

            /*
            |--------------------------------------------------------------------------
            | EMPTY STATE
            |--------------------------------------------------------------------------
            */

            ->emptyStateIcon('heroicon-o-banknotes')

            ->emptyStateHeading('No existen costos registrados')

            ->emptyStateDescription(
                'Comience registrando costos operativos para esta campaña.'
            );
    }
}