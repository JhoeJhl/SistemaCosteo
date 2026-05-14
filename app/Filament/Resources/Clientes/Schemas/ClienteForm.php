<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;


class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Cliente')
                    ->description('Registro de compradores para análisis de rentabilidad.')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre o Razón Social')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            Select::make('tipo')
                                ->label('Tipo de Cliente')
                                ->options([
                                    'mayorista' => 'Mayorista',
                                    'minorista' => 'Minorista',
                                    'exportador' => 'Exportador',
                                ])
                                ->native(false)
                                ->required(),

                            TextInput::make('email')
                                ->label('Correo Electrónico')
                                ->email()
                                ->maxLength(255),

                            TextInput::make('telefono')
                                ->label('Teléfono/WhatsApp')
                                ->tel()
                                ->prefixIcon('heroicon-m-phone'),

                            TextInput::make('direccion')
                                ->label('Dirección de Entrega')
                                ->maxLength(255),
                        ]),
                    ]),
            ]);
    }
}