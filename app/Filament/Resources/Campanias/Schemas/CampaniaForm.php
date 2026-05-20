<?php

namespace App\Filament\Resources\Campanias\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CampaniaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Configuración de la Campaña')
                    ->description('Define el periodo de procesamiento.')
                    ->schema([

                        // Campo nombre de campaña
                        TextInput::make('nombre')
                            ->label('Nombre de la Campaña')
                            ->placeholder('Ej. Campaña 2026 - Fase 1')
                            ->required()
                            ->unique(ignoreRecord: true) 
                            ->maxLength(255)
                            ->columnSpanFull(),
                        //Campo fecha inicio de campaña
                        DatePicker::make('fecha_inicio')
                            
                            ->label('Fecha de Inicio')
                            ->required()
                            ->native(false) 
                            ->displayFormat('d/m/Y'),

                        //Campo fecha fin con validacion a no ser menor con la fecha inicio
                        DatePicker::make('fecha_fin')
                            ->label('Fecha de Fin')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->after('fecha_inicio')
                            ->validationMessages([
                                'after' => 'La fecha de fin debe ser obligatoriamente posterior a la fecha de inicio.'
                            ]),

                        Toggle::make('is_active')
                            ->label('Campaña Activa')
                            ->helperText('Al activar esta campaña, cualquier otra campaña en curso se cerrará automáticamente.')
                            ->onColor('success')
                            ->columnSpanFull(),
                    ])->columnSpan('full'),
            ]);
    }
}
