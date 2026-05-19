<?php

namespace App\Filament\Resources\EntradaMercancias\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;

class EntradaMercanciaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                // Sección 1: Datos Principales de la Entrada
                Section::make('Detalle de Ingreso')
                    ->description('Registre el proveedor, el producto y la cantidad recibida.')
                    ->icon('heroicon-m-arrow-down-tray')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('proveedor_id')
                                ->label('Proveedor')
                                ->relationship('proveedor', 'nombre')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->prefixIcon('heroicon-m-truck'),

                            Select::make('producto_id')
                                ->label('Producto / Material')
                                ->relationship('producto', 'nombre') // Ajusta 'nombre' si tu columna se llama distinto
                                ->searchable()
                                ->preload()
                                ->required()
                                ->prefixIcon('heroicon-m-cube'),

                            TextInput::make('cantidad')
                                ->label('Cantidad que Entra')
                                ->numeric()
                                ->required()
                                ->suffix('Kg / Unid.'),

                            TextInput::make('precio')
                                ->label('Precio Unitario')
                                ->numeric()
                                ->required()
                                ->prefix('Bs.'),
                        ]),

                        Toggle::make('es_compra_en_planta')
                            ->label('¿Es Compra en Planta?')
                            ->onColor('success')
                            ->inline(false)
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(['default' => 12, 'lg' => 7]), // Ocupa el lado izquierdo en PC

                // Sección 2: Costos Adicionales (Repeater)
                Section::make('Costos Adicionales')
                    ->description('Agregue fletes, estibadores u otros gastos de esta entrada.')
                    ->icon('heroicon-m-currency-dollar')
                    ->schema([
                        // EL COMPONENTE REPEATER
                        Repeater::make('costos_adicionales')
                            ->label('')
                            ->schema([
                                TextInput::make('descripcion')
                                    ->label('Descripción del Costo')
                                    ->required()
                                    ->placeholder('Ej. Transporte, Estibaje...'),

                                TextInput::make('precio')
                                    ->label('Costo')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Bs.'),
                            ])
                            ->columns(2)
                            ->defaultItems(0) // Empieza vacío hasta que hagan clic en agregar
                            ->addActionLabel('Agregar Costo Adicional')
                            ->reorderableWithButtons(),
                    ])
                    ->columnSpan(['default' => 12, 'lg' => 5]), // Ocupa el lado derecho en PC

            ]);
    }
}
