<?php

namespace App\Filament\Resources\ProductoTerminados\Pages;

use App\Filament\Resources\ProductoTerminados\ProductoTerminadoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProductoTerminado extends EditRecord
{
    protected static string $resource = ProductoTerminadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
