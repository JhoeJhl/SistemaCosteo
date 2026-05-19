<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

class ListClientes extends ListRecords
{
    protected static string $resource = ClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Nuevo Cliente'),
        ];
    }

    //Titulo
    public function getTitle(): string
    {
        return 'Clientes';
    }

    //getBreadCrumb
    public function getBreadcrumb(): ?string
    {
        return 'Lista de Clientes';
    }
}
