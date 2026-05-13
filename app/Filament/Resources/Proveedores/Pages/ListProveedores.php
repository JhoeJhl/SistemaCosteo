<?php

namespace App\Filament\Resources\Proveedores\Pages;

use App\Filament\Resources\Proveedores\ProveedoresResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProveedores extends ListRecords
{
    protected static string $resource = ProveedoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
