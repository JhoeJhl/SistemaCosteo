<?php

namespace App\Filament\Resources\ProductoTerminados\Pages;

use App\Filament\Resources\ProductoTerminados\ProductoTerminadoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductoTerminado extends ViewRecord
{
    protected static string $resource = ProductoTerminadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
