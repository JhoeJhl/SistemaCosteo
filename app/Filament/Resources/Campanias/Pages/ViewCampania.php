<?php

namespace App\Filament\Resources\Campanias\Pages;

use App\Filament\Resources\Campanias\CampaniaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCampania extends ViewRecord
{
    protected static string $resource = CampaniaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
