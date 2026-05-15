<?php

namespace App\Filament\Resources\Almacens\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Almacens\AlmacenResource;

class CreateAlmacen extends CreateRecord
{
    protected static string $resource = AlmacenResource::class;

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }
}