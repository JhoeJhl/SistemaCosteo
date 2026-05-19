<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;


class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    public function getTitle(): string
    {
        return 'Registrar Cliente';
    }

    //Breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Registrar';
    }

    // Boton de guardar
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Guardar');
    }

    //Boton de guardar y crear otro
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Guardar y crear otro');
    }

    //Boton de cancelar
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar');
    }

}
