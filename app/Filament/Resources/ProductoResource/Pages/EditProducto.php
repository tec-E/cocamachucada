<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditProducto extends EditRecord
{
    protected static string $resource = ProductoResource::class;
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
            ->title('Producto  actualizada')
            ->body('El Producto a sido actualizada')
            ->success()
            ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('Producto eliminado')
                        //->icon('heroicon-o-trash-can')
                        ->color('danger')
                        ->body('El Producto a sido eliminada')
                        ->success()
                ),
        ];
    }
}
