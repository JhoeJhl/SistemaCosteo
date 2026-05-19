<?php

namespace App\Filament\Resources\Clientes\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ClientesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Columna C.I o NIT
                TextColumn::make('ci_bit')
                    ->label('NIT o C.I.')
                    ->searchable(),

                // Columna nombre
                TextColumn::make('nombre')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                //Columna Tipo
                TextColumn::make('tipo')
                    ->label('Clasificación')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'exportador' => 'success', // Verde
                        'mayorista' => 'info',    // Azul
                        'minorista' => 'gray',    // Gris
                        default => 'gray',
                    })
                    ->formatStateUsing(fn($state) => ucfirst($state)),

                // Columna telefono
                TextColumn::make('telefono')
                    ->label('Contacto')
                    ->icon('heroicon-m-phone')
                    ->searchable(),

                // Columna direccion
                TextColumn::make('direccion')
                    ->label('Direccion de Entrega')
                    ->searchable(),

                //Columna correo electronico
                TextColumn::make('email')
                    ->label('Correo')
                    ->icon('heroicon-m-envelope')
                    ->toggleable(isToggledHiddenByDefault: true), // Oculto por defecto para limpiar la vista
            ])
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])

            //Cuando no hay informacion por mostrar
            ->emptyStateHeading('No existen Clientes registrados')
            ->emptyStateDescription('Crea un cliente para comenzar a administrar')
            ->emptyStateIcon('heroicon-o-users')
            ->searchPlaceholder('Buscar por C.I o NIT');
    }
}
