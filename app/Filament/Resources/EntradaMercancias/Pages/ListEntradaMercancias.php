<?php

namespace App\Filament\Resources\EntradaMercancias\Pages;

use App\Filament\Resources\EntradaMercancias\EntradaMercanciaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEntradaMercancias extends ListRecords
{
    protected static string $resource = EntradaMercanciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
