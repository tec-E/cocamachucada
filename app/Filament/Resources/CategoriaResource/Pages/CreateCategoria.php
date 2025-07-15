<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;
    //metodo para direccionar a la tabla
    protected function getRedirectUrl(): string
    {
        return $this::getResource()::getUrl('index');
    }
    //bloqueamo el mensaje por defecto
    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
    //creamo el mensaje personalizado
    protected function afterCreate(){
        Notification::make()
            ->title('Categoria creada')
            ->body('La categoria a sido creada')
            ->success()
            ->send();
    }
    //personalizar botones del formulario crear
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Registrar')
                ->color('success'),
            //   $this->getCreateAnotherFormAction()
            //   ->label('Guardar y nuevo'),
            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }
}
