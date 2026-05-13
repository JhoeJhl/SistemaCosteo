<?php

namespace App\Filament\Resources\Almacens\Pages;

use App\Filament\Resources\Almacens\AlmacenResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAlmacen extends ViewRecord
{
    protected static string $resource = AlmacenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
