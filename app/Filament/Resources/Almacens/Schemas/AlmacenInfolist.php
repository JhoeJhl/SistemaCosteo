<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AlmacenInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('tipo')
                    ->badge(),
                TextEntry::make('descripcion')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
