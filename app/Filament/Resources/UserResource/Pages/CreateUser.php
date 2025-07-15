<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
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
            ->title('Usuario creada')
            ->body('El usuario a sido creada')
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
