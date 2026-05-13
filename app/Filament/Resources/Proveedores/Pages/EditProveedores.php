<?php

namespace App\Filament\Resources\Proveedores\Pages;

use App\Filament\Resources\Proveedores\ProveedoresResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProveedores extends EditRecord
{
    protected static string $resource = ProveedoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
