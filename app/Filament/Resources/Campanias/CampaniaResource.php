<?php

namespace App\Filament\Resources\Campanias;

use BackedEnum;
use App\Models\Campania;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;

// Pages
use App\Filament\Resources\Campanias\Pages\EditCampania;
use App\Filament\Resources\Campanias\Pages\ManageCostoCampania;

use App\Filament\Resources\Campanias\Pages\ListCampanias;
use App\Filament\Resources\Campanias\Pages\CreateCampania;
use App\Filament\Resources\Campanias\Pages\ManageCostosVariables;
// Form & Table
use App\Filament\Resources\Campanias\Schemas\CampaniaForm;
use App\Filament\Resources\Campanias\Tables\CampaniasTable;

// Infolist Components
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;

// Support
use Filament\Support\Enums\FontWeight;

class CampaniaResource extends Resource
{
    protected static ?string $model = Campania::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Campañas';

    protected static ?string $modelLabel = 'Campaña';

    protected static ?string $pluralModelLabel = 'Campañas';

    public static function form(Schema $schema): Schema
    {
        return CampaniaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make(12)
                    ->schema([

                        // Informacion general
                        Section::make('Información General de la Campaña')
                            ->description('Resumen ejecutivo y estado actual de la campaña de producción.')
                            ->icon('heroicon-m-megaphone')
                            ->aside()
                            ->collapsible()
                            ->compact()
                            ->columns(12)
                            ->schema([
                                //nombre
                                TextEntry::make('nombre')
                                    ->label('Campaña')
                                    ->weight(FontWeight::Bold)
                                    ->size('large')
                                    ->color('primary')
                                    ->icon('heroicon-m-flag')
                                    ->copyable()
                                    ->columnSpan(8),

                                //estado
                                IconEntry::make('is_active')
                                    ->label('Estado')
                                    ->boolean()
                                    ->trueIcon('heroicon-m-check-badge')
                                    ->falseIcon('heroicon-m-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger')
                                    ->alignCenter()
                                    ->columnSpan(4),
                                
                                //codigo
                                TextEntry::make('codigo_campania')
                                    ->label('Código de Campaña')
                                    ->badge()
                                    ->color('info')
                                    ->icon('heroicon-m-hashtag')
                                    ->copyable()
                                    ->columnSpan(4),

                                //fecha inicio
                                TextEntry::make('fecha_inicio')
                                    ->label('Fecha de Inicio')
                                    ->date('d M Y')
                                    ->icon('heroicon-m-calendar-days')
                                    ->color('gray')
                                    ->columnSpan(4),

                                //fecha fin
                                TextEntry::make('fecha_fin')
                                    ->label('Fecha de Finalización')
                                    ->date('d M Y')
                                    ->placeholder('Campaña en curso')
                                    ->icon('heroicon-m-calendar')
                                    ->color('gray')
                                    ->columnSpan(4),

                            ])
                            ->columnSpan('full'),

                        //Seccion de Costos fijos e indirectos
                        Section::make('Costos Fijos e Indirectos')
                            ->description('Control financiero detallado de costos registrados en la campaña.')
                            ->icon('heroicon-m-banknotes')
                            ->collapsible()
                            ->compact()
                            ->schema([

                                RepeatableEntry::make('costoCampanias')
                                    ->label('')
                                    ->contained(false)
                                    ->grid(1)
                                    ->placeholder('No existen costos registrados todavía para esta campaña.')
                                    ->schema([

                                        Section::make()
                                            ->compact()
                                            ->columns(12)
                                            ->schema([

                                                //Clasificacion
                                                TextEntry::make('clasificacion')
                                                    ->label('Tipo')
                                                    ->badge()
                                                    ->weight(FontWeight::Bold)
                                                    ->color(
                                                        fn($state) =>
                                                        $state === 'Fijo'
                                                            ? 'info'
                                                            : 'warning'
                                                    )
                                                    ->icon('heroicon-m-tag')
                                                    ->columnSpan(2),

                                                //Descripcion
                                                TextEntry::make('descripcion')
                                                    ->label('Descripción')
                                                    ->weight(FontWeight::SemiBold)
                                                    ->icon('heroicon-m-document-text')
                                                    ->limit(60)
                                                    ->tooltip(
                                                        fn($state) => $state
                                                    )
                                                    ->columnSpan(4),

                                                //Monto
                                                TextEntry::make('monto')
                                                    ->label('Monto Registrado')
                                                    ->money('BOB', true)
                                                    ->weight(FontWeight::Bold)
                                                    ->size('large')
                                                    ->color('success')
                                                    ->alignEnd()
                                                    ->icon('heroicon-m-currency-dollar')
                                                    ->columnSpan(3),

                                                //Estado de pago
                                                IconEntry::make('esta_pagado')
                                                    ->label('Pagado')
                                                    ->boolean()
                                                    ->trueIcon('heroicon-m-check-circle')
                                                    ->falseIcon('heroicon-m-clock')
                                                    ->trueColor('success')
                                                    ->falseColor('warning')
                                                    ->alignCenter()
                                                    ->columnSpan(1),

                                                //Fecha de registro
                                                TextEntry::make('fecha_registro')
                                                    ->label('Fecha Registro')
                                                    ->date('d/m/Y')
                                                    ->icon('heroicon-m-calendar-days')
                                                    ->color('gray')
                                                    ->columnSpan(2),

                                            ]),
                                    ]),

                            ])
                            ->columnSpan('full'),
                    ])
                    ->columnSpan('full'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return CampaniasTable::configure($table);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\CostoCampaniasRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListCampanias::route('/'),
            'create' => CreateCampania::route('/create'),
            'edit' => EditCampania::route('/{record}/edit'),
            // 'view' => ViewCampania::route('/{record}'),
            

            'costos' => ManageCostoCampania::route('/{record}/costos'), 
            'variables' => ManageCostosVariables::route('/{record}/costos-variables')
            ];
    }
}
