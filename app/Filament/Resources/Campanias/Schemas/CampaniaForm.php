<?php

namespace App\Filament\Resources\Campanias\Schemas;

use Filament\Actions\Action;
use Filament\Schemas\Components\Utilities\Set;
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

                        //campo de codigo
                        TextInput::make('codigo_campania')
                            ->label('Código de Campaña')
                            ->helperText('Pulse el icono al final del campo para genera un codigo aleatorio o Agregue uno')
                            ->required()
                            ->placeholder('Ej. CPS-0M03S')
                            ->prefixIcon('heroicon-m-qr-code')
                            ->suffixAction(
                                Action::make('generar_codigo')
                                    ->icon('heroicon-m-arrow-path')
                                    ->tooltip('Generar código aleatorio')
                                    ->action(function (Set $set) {

                                        $codigo = 'CPS-' . strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 5));
                                        $set('codigo_campania', $codigo);
                                    })
                            ),

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
