<?php

namespace App\Filament\Resources\Almacens\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;


class AlmacenInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | RESUMEN PRINCIPAL
                |--------------------------------------------------------------------------
                */

                Section::make()
                    ->schema([

                        Grid::make(12)
                            ->schema([

                                TextEntry::make('nombre')
                                    ->label('ALMACÉN')
                     
                                    ->weight(FontWeight::ExtraBold)
                                    ->color('primary')
                                    ->icon('heroicon-m-building-office-2')
                                    ->iconPosition(IconPosition::Before)
                                    ->columnSpan(5),

                                TextEntry::make('codigo_almacen')
                                    ->label('CÓDIGO')
                                    ->badge()
                                    ->color('gray')
                                    ->copyable()
                                    ->copyMessage('Código copiado')
                                    ->icon('heroicon-m-qr-code')
                                    ->columnSpan(3),

                                TextEntry::make('estado')
                                    ->label('ESTADO')
                                    ->badge()
                    
                                    ->color(fn(string $state): string => match (strtolower($state)) {
                                        'activo' => 'success',
                                        'inactivo' => 'danger',
                                        default => 'warning',
                                    })
                                    ->icon(fn(string $state): string => match (strtolower($state)) {
                                        'activo' => 'heroicon-m-check-badge',
                                        'inactivo' => 'heroicon-m-x-circle',
                                        default => 'heroicon-m-exclamation-triangle',
                                    })
                                    ->formatStateUsing(fn($state) => ucfirst($state))
                                    ->columnSpan(2),

                                TextEntry::make('tipo')
                                    ->label('TIPO')
                                    ->badge()
                                    ->color(fn($state) => match ($state) {
                                        'MP' => 'warning',
                                        'PT' => 'info',
                                        default => 'gray',
                                    })
                                    ->icon(fn($state) => match ($state) {
                                        'MP' => 'heroicon-m-archive-box',
                                        'PT' => 'heroicon-m-cube',
                                        default => 'heroicon-m-squares-2x2',
                                    })
                                    ->formatStateUsing(fn($state) => match ($state) {
                                        'MP' => 'Materia Prima',
                                        'PT' => 'Producto Terminado',
                                        default => $state,
                                    })
                                    ->columnSpan(2),

                            ]),

                    ])
                    ->compact()
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | INFORMACIÓN OPERATIVA
                |--------------------------------------------------------------------------
                */

                Section::make('Información Operativa')
                    ->description('Datos generales y operativos del almacén.')
                    ->icon('heroicon-m-information-circle')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('created_at')
                                    ->label('Fecha de Registro')
                                    ->icon('heroicon-m-calendar-days')
                                    ->dateTime('d/m/Y H:i')
                                    ->color('gray'),

                                TextEntry::make('updated_at')
                                    ->label('Última Actualización')
                                    ->icon('heroicon-m-clock')
                                    ->since()
                                    ->color('gray'),

                            ]),

                    ])
                    ->columns(1)
                    ->compact(),

                /*
                |--------------------------------------------------------------------------
                | DESCRIPCIÓN
                |--------------------------------------------------------------------------
                */

                Section::make('Descripción General')
                    ->description('Detalle descriptivo y ubicación logística.')
                    ->icon('heroicon-m-map-pin')
                    ->schema([

                        TextEntry::make('descripcion')
                            ->hiddenLabel()
                            ->placeholder('No existe una descripción registrada.')
                            ->prose()
                            ->columnSpanFull(),

                    ])
                    ->compact()
                    ->collapsible(),

            ]);
    }
}