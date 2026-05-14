<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AlmacenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Creacion de un Proveedor')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre del Producto')
                            ->required(),
                        Select::make('tipo')
                            ->label('Tipo de Producto')
                            ->options([
                                'materia_prima' => 'Materia prima',
                                'producto_terminado' => 'Producto terminado',
                                'camara_fria' => 'Camara fria',
                            ])
                            ->required(),
                        Textarea::make('descripcion')
                            ->placeholder('Comentario...')
                            ->columnSpanFull(),
                    ])->columns(2)

            ]);
    }
}
