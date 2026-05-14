<?php

namespace App\Filament\Resources\Proveedors\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ProveedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextEntry::make('nombre')
                    ->label('Nombre del Productor')
                    ->weight('bold') // Pone el nombre en negrita para resaltarlo
                    ->size('lg'),    // Aumenta ligeramente el tamaño de la fuente

                TextEntry::make('comunidad')
                    ->label('Comunidad')
                    ->default('No registrada'), // Muestra esto si el campo está vacío (nullable)

                TextEntry::make('telefono')
                    ->label('Teléfono')
                    ->icon('heroicon-m-phone') // Añade un pequeño ícono de teléfono
                    ->default('No registrado'),

                TextEntry::make('direccion')
                    ->label('Dirección')
                    ->columnSpanFull() // Hace que ocupe todo el ancho de la tarjeta
                    ->default('No registrada'),

            ]);
    }
}
