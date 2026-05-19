<?php

namespace App\Filament\Resources\ProductoTerminados\Pages;

use App\Filament\Resources\ProductoTerminados\ProductoTerminadoResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;


class CreateProductoTerminado extends CreateRecord
{
    protected static string $resource = ProductoTerminadoResource::class;

  
    // Cambia el título principal
    public function getTitle(): string
    {
        return 'Registrar Producto';
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
