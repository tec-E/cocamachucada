<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Grid::make(2) // Divide en 2 columnas
                    ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->placeholder('Escriba el nombre')
                    ->maxLength(255),
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoria')
                            ->required()
                            ->options(Categoria::all()->pluck('nombre', 'id')),
                Forms\Components\TextInput::make('precio')
                    ->placeholder('00.0 Bs')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('productos'),
                        Forms\Components\Select::make('user_id')
                            ->label('Usuario')
                            ->required()
                            ->options(\App\Models\User::all()->pluck('name', 'id')) // lista de usuarios
                            ->default(auth()->id()) // 👈 este es el truco
                            ->native(false) ,// (opcional) para mostrar un select estilizado con Filament
                Forms\Components\Textarea::make('descripcion')
                     ->placeholder('Escriba una descripcion')
                     ->columnSpanFull(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('id')
                      ->sortable()
                      ->label('Nro')
                      ->rowIndex(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('imagen')
                    ->limit(15)
                    ->searchable(),
                Tables\Columns\TextColumn::make('User.name')
                    ->label('Usuario')
                    ->limit(15)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoria')
                    ->limit(15)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modificado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->color('success'),
                //agregamos el boton eliminar en la tabla
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->title('Producto eliminado')
                            ->body('El  producto a sido eliminada')
                            ->success()
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
