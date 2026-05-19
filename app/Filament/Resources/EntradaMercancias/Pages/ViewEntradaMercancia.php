<?php

namespace App\Filament\Resources\EntradaMercancias\Pages;

use App\Filament\Resources\EntradaMercancias\EntradaMercanciaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEntradaMercancia extends ViewRecord
{
    protected static string $resource = EntradaMercanciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
