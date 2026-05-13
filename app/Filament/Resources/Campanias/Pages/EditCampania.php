<?php

namespace App\Filament\Resources\Campanias\Pages;

use App\Filament\Resources\Campanias\CampaniaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCampania extends EditRecord
{
    protected static string $resource = CampaniaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
