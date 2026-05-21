<?php

namespace App\Filament\Resources\Campanias\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class CostosVariablesStats extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        if (! $this->record) return [];

        $costos = $this->record->costosVariables;

        $totalManoObra = $costos->where('categoria', 'Mano de Obra')->sum('monto');
        $totalProcesamiento = $costos->where('categoria', 'Procesamiento')->sum('monto');
        $totalEmpaqueTransporte = $costos->whereIn('categoria', ['Empaque', 'Transporte'])->sum('monto');
        $granTotal = $costos->sum('monto');

        return [
            Stat::make('Total Variables (M2)', 'Bs. ' . number_format($granTotal, 2))
                ->description('Gasto operativo directo')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),

            Stat::make('Mano de Obra Directa', 'Bs. ' . number_format($totalManoObra, 2))
                ->description('Jornales y turnos extra')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Procesamiento y Energía', 'Bs. ' . number_format($totalProcesamiento, 2))
                ->description('Despulpado y maquinaria')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('success'),
                
            Stat::make('Logística y Empaque', 'Bs. ' . number_format($totalEmpaqueTransporte, 2))
                ->description('Bolsas y distribución')
                ->descriptionIcon('heroicon-m-truck')
                ->color('warning'),
        ];
    }
}