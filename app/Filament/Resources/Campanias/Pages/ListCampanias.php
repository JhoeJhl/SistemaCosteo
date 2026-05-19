<?php

namespace App\Filament\Resources\Campanias\Pages;

use App\Filament\Resources\Campanias\CampaniaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCampanias extends ListRecords
{
    protected static string $resource = CampaniaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nueva Campaña'),
        ];
    }

    public function getTitle(): string
    {
        return 'Campañas';
    }

    public function getBreadcrumb(): ?string
    {
        return 'Lista de Campañas';
    }
}
