<?php

namespace App\Filament\Resources\Campanias\Pages;

use App\Filament\Resources\Campanias\CampaniaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class EditCampania extends EditRecord
{
    protected static string $resource = CampaniaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
    
    //Cambiar titulo 
    public function getTitle(): string|Htmlable
    {
        return 'Editando: ' . $this->record->nombre;
    }
    
    public function getContentTabLabel(): ?string
    {
        return 'Datos Generales';
    }
    
    protected function getFormActions(): array
    {
        return parent::getFormActions();
    }

  
    // cambiar breadcrumb
    public function getBreadcrumb(): string
    {
        return 'Modificar datos o Agregar Costos';
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
