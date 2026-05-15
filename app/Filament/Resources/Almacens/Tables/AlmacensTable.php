<?php

namespace App\Filament\Resources\Almacens\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Stack;

class AlmacensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Stack apila los elementos uno debajo del otro dentro de la misma "celda" o tarjeta
                Stack::make([
                    
                    // 1. Nombre del Almacén con un ícono dinámico según el tipo
                    TextColumn::make('nombre')
                        ->weight('bold')
                        ->size('TextColumnSize::Large') // Texto más grande para el título
                        ->searchable()
                        ->icon(fn ($record) => $record->tipo === 'MP' ? 'heroicon-m-archive-box' : 'heroicon-m-cube')
                        ->iconColor(fn ($record) => $record->tipo === 'MP' ? 'warning' : 'info'),

                    // 2. La etiqueta (Badge) del tipo de operación
                    TextColumn::make('tipo')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'MP' => 'warning', // Naranja
                            'PT' => 'info',    // Azul
                        })
                        ->formatStateUsing(fn ($state) => match ($state) {
                            'MP' => 'Materia Prima (Fruta)',
                            'PT' => 'Producto Terminado (Pulpa)',
                        }),

                    // 3. Una breve descripción en texto gris
                    TextColumn::make('descripcion')
                        ->color('gray')
                        ->limit(80)
                        ->size('sm')
                        ->default('Sin descripción adicional.'),
                        
                ])->space(3), // Añade un espacio elegante entre el nombre, el badge y la descripción
            ])
            // --- LA MAGIA VISUAL: Transforma las filas en una cuadrícula de tarjetas ---
            ->contentGrid([
                'md' => 2, // En monitores medianos muestra 2 tarjetas por fila
                'xl' => 3, // En monitores grandes muestra 3 tarjetas por fila
            ])
            ->paginated(false); // Como son pocos almacenes, quitamos la paginación para mantener la pantalla limpia
    }
}