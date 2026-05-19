<?php

namespace App\Filament\Resources\EntradaMercancias\Pages;

use App\Filament\Resources\EntradaMercancias\EntradaMercanciaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEntradaMercancia extends EditRecord
{
    protected static string $resource = EntradaMercanciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
