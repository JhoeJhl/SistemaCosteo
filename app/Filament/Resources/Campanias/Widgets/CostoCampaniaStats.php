<?php

namespace App\Filament\Resources\Campanias\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class CostoCampaniaStats extends StatsOverviewWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        if (! $this->record) {
            return [];
        }

        $costos = $this->record->costoCampanias;

        $totalFijos = $costos->where('clasificacion', 'Fijo')->sum('monto');
        $totalIndirectos = $costos->where('clasificacion', 'Indirecto')->sum('monto');
        $totalGeneral = $totalFijos + $totalIndirectos;

        $pagados = $costos->where('esta_pagado', true)->sum('monto');
        $pendientes = $costos->where('esta_pagado', false)->sum('monto');

        return [
            Stat::make('Total Fijos', 'Bs. ' . number_format($totalFijos, 2))
                ->description('Costos estructurales')
                ->descriptionIcon('heroicon-m-lock-closed')
                ->color('info'),

            Stat::make('Total Indirectos', 'Bs. ' . number_format($totalIndirectos, 2))
                ->description('Variación operativa')
                ->descriptionIcon('heroicon-m-arrow-path-rounded-square')
                ->color('warning'),

            Stat::make('Gran Total (M1)', 'Bs. ' . number_format($totalGeneral, 2))
                ->description('Inversión total de campaña')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),

            Stat::make('Pagado vs Pendiente', 'Bs. ' . number_format($pagados, 2) . ' / Bs. ' . number_format($pendientes, 2))
                ->description('Flujo de caja')
                ->descriptionIcon($pendientes > 0 ? 'heroicon-m-clock' : 'heroicon-m-check-circle')
                ->color($pendientes > 0 ? 'danger' : 'success'),
        ];
    }
}
