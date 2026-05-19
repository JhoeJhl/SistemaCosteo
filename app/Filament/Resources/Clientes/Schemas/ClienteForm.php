<?php

namespace App\Filament\Resources\Clientes\Schemas;

// Manteniendo TUS rutas exactas que funcionan sin errores
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Bloque 1: Identificación Comercial
                Section::make('Identificación Comercial')
                    ->description('Datos oficiales para facturación y registro.')
                    ->icon('heroicon-m-identification')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('nombre')
                                ->label('Nombre Comercial o Razón Social')
                                ->required()
                                ->maxLength(255)
                                ->prefixIcon('heroicon-m-briefcase')
                                ->columnSpan(['default' => 3, 'md' => 2]),

                            TextInput::make('nit_ci')
                                ->label('NIT o C.I.')
                                ->required()
                                ->prefixIcon('heroicon-m-hashtag')
                                
                                ->maxLength(20)
                                ->extraInputAttributes([
                                    'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')",
                                ])
                                ->columnSpan(['default' => 3, 'md' => 1]),

                            Select::make('tipo')
                                ->label('Tipo de Cliente')
                                ->placeholder('Seleccione una opción')
                                ->options([
                                    'mayorista' => 'Mayorista',
                                    'minorista' => 'Minorista',
                                    'exportador' => 'Exportador',
                                    'otro' => '➕ Agregar nuevo tipo...',
                                ])
                                ->native(false)
                                ->required()
                                ->live()
                                ->columnSpan(['default' => 3, 'md' => 2]),

                            // Campo para crear un nuevo tipo de cliente
                            TextInput::make('nuevo_tipo')
                                ->label('Especifique el nuevo tipo')
                                ->placeholder('Ej. Distribuidor Regional')
                                ->hidden(fn(Get $get) => $get('tipo') !== 'otro')
                                ->requiredIf('tipo', 'otro')
                                ->columnSpan(['default' => 3, 'md' => 1]),
                        ]),
                    ])
                    ->columnSpan('full'),

                // Bloque 2: Contacto y Logística
                Section::make('Contacto y Logística')
                    ->description('Información para despachos de pulpa y comunicación.')
                    ->icon('heroicon-m-map-pin')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('telefono')
                                ->label('Teléfono / WhatsApp')
                                ->tel()
                                ->prefixIcon('heroicon-m-phone'),

                            TextInput::make('email')
                                ->label('Correo Electrónico')
                                ->email()
                                ->prefixIcon('heroicon-m-envelope')
                                ->maxLength(255),

                            TextInput::make('direccion')
                                ->label('Dirección de Entrega')
                                ->prefixIcon('heroicon-m-truck')
                                ->columnSpanFull()
                                ->maxLength(255),
                        ]),
                    ])
                    ->columnSpan('full'),

            ]);
    }
}
