<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProducto extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // asigna el usuario logeado
        return $data;
    }
    protected static string $resource = ProductoResource::class;
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
            ->title('Producto creada')
            ->body('El Producto a sido creada')
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
