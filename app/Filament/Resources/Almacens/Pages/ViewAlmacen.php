<?php

namespace App\Filament\Resources\Almacens\Pages;

use App\Filament\Resources\Almacens\AlmacenResource;
use Filament\Actions\CreateAction;

use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class ViewAlmacen extends ViewRecord
{
    protected static string $resource = AlmacenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Editar Almacen'),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Visualizacion del Almacen';
    }

    public function getBreadcrumb(): string
    {
        return 'Visualizacion Almacen';
    }

}
