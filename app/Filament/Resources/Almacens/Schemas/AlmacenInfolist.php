<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;

class AlmacenInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([

                Section::make('Ficha Técnica de Almacén')
                    ->icon('heroicon-m-information-circle')

                    ->schema([

                        Grid::make(3)
                            ->schema([

                                TextEntry::make('nombre')
                                    ->label('Nombre')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('tipo')
                                    ->label('Categoría Operativa')
                                    ->badge()

                                    ->color(
                                        fn($state) =>
                                        $state === 'MP'
                                            ? 'warning'
                                            : 'info'
                                    )

                                    ->formatStateUsing(
                                        fn($state) =>
                                        $state === 'MP'
                                            ? 'Materia Prima'
                                            : 'Producto Terminado'
                                    ),

                                TextEntry::make('created_at')
                                    ->label('Fecha de Registro')
                                    ->dateTime('d/m/Y H:i'),

                                TextEntry::make('descripcion')
                                    ->label('Descripción o Ubicación')
                                    ->columnSpanFull()
                                    ->placeholder('Sin descripción detallada.'),

                            ]),

                    ]),

            ]);
    }
}