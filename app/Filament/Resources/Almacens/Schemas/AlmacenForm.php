<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

// Importaciones agregadas para los nuevos campos
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;


class AlmacenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registro de Almacén')
                    ->description('Complete la información operativa del almacén.')
                    ->icon('heroicon-m-building-storefront')
                    ->schema([
                        // 1. CAMPO NUEVO: Código con generador aleatorio
                        TextInput::make('codigo_almacen')
                            ->label('Código de Almacén')
                            ->helperText('Pulse el icono al final del campo para genera un codigo aleatorio o Agregue uno')
                            ->required()
                            ->placeholder('Ej. ALM-001')
                            ->prefixIcon('heroicon-m-qr-code')
                            ->suffixAction(
                                Action::make('generar_codigo')
                                    ->icon('heroicon-m-arrow-path')
                                    ->tooltip('Generar código aleatorio')
                                    ->action(function (Set $set) {
                                        // Genera un código del tipo ALM- + 5 caracteres aleatorios alfanuméricos
                                        $codigo = 'ALM-' . strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5));
                                        $set('codigo_almacen', $codigo);
                                    })
                            ),

                        TextInput::make('nombre')
                            ->label('Nombre del Almacén')
                            ->required()
                            ->placeholder('Ej. Cámara Fría Norte')
                            ->prefixIcon('heroicon-m-identification'),

                        // Estado puede ser activo, inactivo, o agregar otro
                        Select::make('estado')
                            ->label('Estado')
                            ->options([
                                'activo' => 'Activo',
                                'inactivo' => 'Inactivo',
                                'otro' => 'Agregar otro estado...',
                            ])
                            ->default('activo')
                            ->native(false)
                            ->required()
                            ->live()

                            //registrar otro tipo de estado
                            ->dehydrateStateUsing(fn($state, Get $get) => $state === 'otro' ? $get('nuevo_estado') : $state),

                        // registrar otro tipo de estado | solo se activa al hacer click en agregar otro estado
                        TextInput::make('nuevo_estado')
                            ->label('Especifique el nuevo estado')
                            ->placeholder('Ej. En mantenimiento, Clausurado...')
                            ->hidden(fn(Get $get) => $get('estado') !== 'otro')
                            ->requiredIf('estado', 'otro')
                            ->dehydrated(false),

                        
                        // campo tipo de almacen MP o PT
                        ToggleButtons::make('tipo')
                            ->label('Tipo de Almacén')
                            ->options([
                                'MP' => 'Materia Prima | MP',
                                'PT' => 'Producto Terminado | PT',
                            ])
                            ->icons([
                                'MP' => 'heroicon-m-archive-box',
                                'PT' => 'heroicon-m-cube',
                            ])
                            ->colors([
                                'MP' => 'warning',
                                'PT' => 'info',
                            ])
                            ->inline()
                            ->required(),

                        Textarea::make('descripcion')
                            ->label('Descripción / Ubicación')
                            ->rows(5)
                            ->placeholder(
                                'Ingrese observaciones, ubicación física o capacidad operativa.'
                            )
                            ->autosize(),
                    ])->columnSpan('full'),
            ]);
    }
}
