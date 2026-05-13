<?php

namespace App\Filament\Resources\Proveedores\Pages;

use App\Filament\Resources\Proveedores\ProveedoresResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProveedores extends ViewRecord
{
    protected static string $resource = ProveedoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
