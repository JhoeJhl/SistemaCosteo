<?php

namespace App\Filament\Resources\Almacens\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Almacens\AlmacenResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class CreateAlmacen extends CreateRecord
{
    protected static string $resource = AlmacenResource::class;

    // Titulo Principal
    public function getTitle(): string|Htmlable
    {
        return 'Registrar Almacén';
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
            ->label('Guardar')
            ->size('xl');
    }

    //Boton de guardar y crear otro
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Guardar y crear otro')
            ->size('xl');;
    }

    //Boton de cancelar
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar')
            ->size('xl');;
    }
}