<?php

namespace App\Filament\Resources\EntradaMercancias\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EntradaMercanciasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('proveedor_id')
                    ->label('Nombre Proveedor')
                    ->searchable(),
            ])
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->paginated([10,25,50])
            
            //Cuando no hay informacion
            ->searchPlaceholder('Buscar por codigo...')
            ->emptyStateHeading('No existen Entradas de Mercancia')
            ->emptyStateDescription('Crea una entrada de mercancia para poder administrar.')
            ->emptyStateIcon('heroicon-o-archive-box-arrow-down');
    }       
}
