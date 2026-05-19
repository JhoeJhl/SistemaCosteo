<?php

namespace App\Filament\Resources\Campanias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CampaniasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Campaña')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('fecha_inicio')
                    ->label('Inicio')
                    ->date('d M, Y') 
                    ->sortable(),

                TextColumn::make('fecha_fin')
                    ->label('Fin')
                    ->formatStateUsing(fn ($state) => $state ? $state->format('d M, Y') : 'En curso...')
                    ->sortable(),
                    
                IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter(),
            ])
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->emptyStateHeading('No existen Campañas Registradas')
            ->emptyStateDescription('Crea una campaña para comenzar a administrar las Campañas')
            ->emptyStateIcon('heroicon-o-calendar-days');
    }
}
