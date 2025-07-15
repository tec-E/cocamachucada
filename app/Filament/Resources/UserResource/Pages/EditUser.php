<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    //metodo para direccionar a la tabla
    protected function getRedirectUrl(): string
    {
        return $this::getResource()::getUrl('index');
    }
    //aqui bloqueamo el mensaje por defecto
    protected function getSavedNotification(): ?Notification
    {
        return null;
    }
    //personalizamo el mensaje
    protected function afterSave(): void{
        Notification::make()
            ->title('Usuario  actualizada')
            ->body('El usuario a sido actualizada')
            ->success()
            ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('Usuario eliminado')
                        //->icon('heroicon-o-trash-can')
                        ->color('danger')
                        ->body('El usuario a sido eliminada')
                        ->success()
                ),
        ];
    }
}
