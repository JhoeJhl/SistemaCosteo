<?php

namespace App\Filament\Resources\Almacens\Pages;

use App\Filament\Resources\Almacens\AlmacenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;


class ListAlmacens extends ListRecords
{
    protected static string $resource = AlmacenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nuevo Almacén')->size('xl'),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Almacenes';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Lista Almacenes';
    }

    // tamaño de la tabla

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }
}