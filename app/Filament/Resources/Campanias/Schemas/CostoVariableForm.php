<?php

namespace App\Filament\Resources\Campanias\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;

class CostoVariableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Costos Variables')
                    ->description('Registro operativo de gastos variables asociados a la producción.')
                    ->icon('heroicon-m-banknotes')
                    ->compact()
                    ->columns(12)
                    ->schema([

                        //Categoria
                        ToggleButtons::make('categoria')
                            ->label('Categoría')
                            ->options([
                                'mano_obra' => 'Mano de Obra',
                                'procesamiento' => 'Procesamiento',
                                'empaque' => 'Empaque',
                                'transporte' => 'Transporte',
                                'energia_operativa' => 'Energía',
                                'otros_variables' => 'Otros',
                            ])
                            ->icons([
                                'mano_obra' => 'heroicon-m-users',
                                'procesamiento' => 'heroicon-m-cog-6-tooth',
                                'empaque' => 'heroicon-m-archive-box',
                                'transporte' => 'heroicon-m-truck',
                                'energia_operativa' => 'heroicon-m-bolt',
                                'otros_variables' => 'heroicon-m-squares-2x2',
                            ])
                            ->inline()
                            ->grouped()
                            ->default('procesamiento')
                            ->required()
                            ->columnSpanFull()
                            ->extraAttributes([
                                'class' => 'text-sm',
                            ]),

                        //fecha de registro
                        DatePicker::make('fecha_registro')
                            ->label('Fecha')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->maxDate(now())
                            ->prefixIcon('heroicon-m-calendar')
                            ->columnSpan(4),

                        // monto
                        TextInput::make('monto')
                            ->label('Monto')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Bs.')
                            ->placeholder('0.00')
                            ->inputMode('decimal')
                            ->prefixIcon('heroicon-m-currency-dollar')
                            ->columnSpan(4),

                        //unidad
                        Select::make('unidad_costo')
                            ->label('Unidad')
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->options([
                                'por_kg' => 'Por Kg',
                                'por_lote' => 'Por Lote',
                                'por_bolsa' => 'Por Bolsa',
                                'por_unidad' => 'Por Unidad',
                            ])
                            ->placeholder('Seleccione')
                            ->prefixIcon('heroicon-m-scale')
                            ->columnSpan(4),

                        //descripcion
                        TextInput::make('descripcion')
                            ->label('Descripción')
                            ->required()
                            ->minLength(10)
                            ->maxLength(255)
                            ->columnSpan('full')
                            ->placeholder('Detalle breve del gasto operativo')
                            ->prefixIcon('heroicon-m-document-text'),

                        //observaciones
                        Textarea::make('observaciones')
                            ->label('Observaciones')
                            ->placeholder('Notas adicionales...')
                            ->rows(3)
                            ->autosize()
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}