<?php

namespace App\Filament\Resources\ProductoTerminados\Pages;

use App\Filament\Resources\ProductoTerminados\ProductoTerminadoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductoTerminados extends ListRecords
{
    protected static string $resource = ProductoTerminadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
