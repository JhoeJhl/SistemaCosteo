<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ClienteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ficha del Cliente')
                    ->schema([
                        TextEntry::make('nombre')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('tipo')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'exportador' => 'success',
                                'mayorista' => 'info',
                                default => 'gray',
                            }),
                        TextEntry::make('telefono')->icon('heroicon-m-phone'),
                        TextEntry::make('email')->icon('heroicon-m-envelope'),
                        TextEntry::make('direccion')->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}