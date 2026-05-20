<?php

namespace App\Filament\Resources\Campanias\Pages;

use App\Filament\Resources\Campanias\CampaniaResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Override;

class CreateCampania extends CreateRecord
{
    protected static string $resource = CampaniaResource::class;

    public function getTitle(): string
    {
        return 'Registrar Campaña';
    }

    //Breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Registrar Campaña';
    }

    // Boton de guardar
    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Guardar')->size('xl');
    }

    //Boton de guardar y crear otro
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Guardar y crear otro')->size('xl');
    }

    //Boton de cancelar
    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar')->size('xl');
    }

    //Metodo para redireccionar al crear un registro
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
