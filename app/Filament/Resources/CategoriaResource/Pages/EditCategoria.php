<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

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
            ->title('Categoria  actualizada')
            ->body('La categoria a sido actualizada')
            ->success()
            ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('Categoria eliminado')
                        //->icon('heroicon-o-trash-can')
                        ->color('danger')
                        ->body('La categoria a sido eliminada')
                        ->success()
                ),
        ];
    }
}
