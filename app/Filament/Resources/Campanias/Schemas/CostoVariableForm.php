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
                Section::make('Detalle del Costo Operativo')
                    ->description('Registre los gastos variables directamente asociados al procesamiento.')
                    ->icon('heroicon-m-cube-transparent')
                    ->columns(12)
                    ->schema([

                        // FILA 1: Clasificación
                        ToggleButtons::make('categoria')
                            ->label('Categoría Operativa')
                            ->options([
                                'Mano de Obra' => 'Mano de Obra',
                                'Procesamiento' => 'Procesamiento',
                                'Empaque' => 'Empaque',
                                'Transporte' => 'Transporte',
                                'Energia Operativa' => 'Energía Operativa',
                                'Otros Variables' => 'Otros Variables',
                            ])
                            ->colors([
                                'Mano de Obra' => 'info',
                                'Procesamiento' => 'primary',
                                'Empaque' => 'success',
                                'Transporte' => 'warning',
                                'Energia Operativa' => 'danger',
                                'Otros Variables' => 'gray',
                            ])
                            ->inline()
                            ->required()
                            ->in(['Mano de Obra', 'Procesamiento', 'Empaque', 'Transporte', 'Energia Operativa', 'Otros Variables'])
                            ->columnSpan(12),

                        // FILA 2: Fechas y Montos
                        DatePicker::make('fecha_registro')
                            ->label('Fecha de Ejecución')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->maxDate(now()->addDays(1)) // Evita fechas futuras exageradas
                            ->prefixIcon('heroicon-m-calendar-days')
                            ->columnSpan(4),

                        TextInput::make('monto')
                            ->label('Monto Invertido')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Bs.')
                            ->columnSpan(4),

                        Select::make('unidad_costo')
                            ->label('Unidad de Medida')
                            ->required()
                            ->native(false)
                            ->options([
                                'por kg' => 'Por Kilogramo (kg)',
                                'por lote' => 'Por Lote',
                                'por bolsa' => 'Por Bolsa',
                                'por unidad' => 'Por Unidad',
                            ])
                            ->in(['por kg', 'por lote', 'por bolsa', 'por unidad'])
                            ->prefixIcon('heroicon-m-scale')
                            ->columnSpan(4),

                        // FILA 3: Descripciones
                        TextInput::make('descripcion')
                            ->label('Descripción Específica')
                            ->required()
                            ->minLength(10)
                            ->maxLength(255)
                            ->placeholder('Ej. Pago a jornaleros por turno de noche')
                            ->prefixIcon('heroicon-m-document-text')
                            ->columnSpan(12),

                        Textarea::make('observaciones')
                            ->label('Observaciones Técnicas (Opcional)')
                            ->maxLength(500)
                            ->rows(2)
                            ->columnSpan(12),
                    ]),
            ]);
    }
}