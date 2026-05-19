<?php

namespace App\Filament\Resources\Proveedors\Pages;

use App\Filament\Resources\Proveedors\ProveedorResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateProveedor extends CreateRecord
{
    protected static string $resource = ProveedorResource::class;
        
    public function getTitle(): string
    {
        return 'Registrar Proveedor';
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
