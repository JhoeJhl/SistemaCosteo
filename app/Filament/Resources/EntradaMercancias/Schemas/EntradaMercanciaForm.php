<?php

namespace App\Filament\Resources\EntradaMercancias\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;


class EntradaMercanciaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información Logística')
                    ->description('Datos de procedencia, destino y fechas.')
                    ->icon('heroicon-m-truck')
                    ->compact()
                    ->columns(12)
                    ->schema([
                        Select::make('campana_id')
                            ->relationship('campana', 'nombre')
                            ->label('Campaña')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-flag')
                            ->columnSpan(3),

                        Select::make('proveedor_id')
                            ->relationship('proveedor', 'nombre')
                            ->label('Proveedor')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-building-storefront')
                            ->columnSpan(3),

                        Select::make('almacen_id')
                            ->relationship('almacen', 'nombre')
                            ->label('Almacén Destino')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-building-office-2')
                            ->columnSpan(3),

                        DatePicker::make('fecha_ingreso')
                            ->label('Fecha Ingreso')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->prefixIcon('heroicon-m-calendar-days')
                            ->columnSpan(3),
                    ]),

                // detalle del operativo
                Section::make('Detalle Operativo')
                    ->description('Especificaciones del producto y costos calculados.')
                    ->icon('heroicon-m-cube')
                    ->compact()
                    ->columns(12)
                    ->columnSpanFull()
                    ->schema([

                        // producto | materia prima
                        Select::make('producto_id')
                            ->relationship('producto', 'nombre')
                            ->label('Producto / Materia Prima')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-cube')
                            ->columnSpan(4),

                        // unidad de medida
                        Select::make('unidad_medida')
                            ->label('Unidad')
                            ->required()
                            ->native(false)
                            ->options([
                                'kg' => 'Kilogramos',
                                'unidades' => 'Unidades',
                                'bolsas' => 'Bolsas',
                                'cajas' => 'Cajas',
                                'litros' => 'Litros',
                            ])
                            ->columnSpan(2),

                        // cantidad
                        TextInput::make('cantidad')
                            ->label('Volumen')
                            ->required()
                            ->numeric()
                            ->minValue(0.01)
                            ->live(debounce: 500)
                            ->prefixIcon('heroicon-m-arrows-up-down')
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::calcularTotal($get, $set))
                            ->columnSpan(2),

                        //costo unitario
                        TextInput::make('costo_unitario')
                            ->label('C. Unitario')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Bs.')
                            ->live(debounce: 500)
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::calcularTotal($get, $set))
                            ->columnSpan(2),

                        //costo total
                        TextInput::make('costo_total')
                            ->label('Costo Total')
                            ->numeric()
                            ->readOnly()
                            ->dehydrated()
                            ->prefix('Bs.')
                            ->extraInputAttributes([
                                'class' => 'font-bold bg-success-50 text-success-700 dark:bg-success-900/30 dark:text-success-400',
                            ])
                            ->columnSpan(2),
                    ]),

                //observaciones
                TextInput::make('observaciones')
                    ->label('Observaciones Adicionales')
                    ->placeholder('Nro de Guía, condiciones de llegada, detalles extras...')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-m-document-text')
            ]);
    }
    private static function calcularTotal(Get $get, Set $set): void
    {
        $cantidad = (float) ($get('cantidad') ?? 0);

        $costoUnitario = (float) ($get('costo_unitario') ?? 0);

        $set(
            'costo_total',
            number_format($cantidad * $costoUnitario, 2, '.', '')
        );
    }
}
