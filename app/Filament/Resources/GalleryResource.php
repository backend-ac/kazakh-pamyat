<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Галерея';
    protected static ?string $navigationGroup = 'Картинки';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->required()
                    ->directory('gallery/images')
                    ->image(),

                // Селект для выбора ряда
                Forms\Components\Select::make('row')
                    ->label('Ряд')
                    ->options([
                        'top' => 'Верхний ряд',
                        'bottom' => 'Нижний ряд',
                    ])
                    ->default('top')
                    ->required(),

                // Поле сортировки
                Forms\Components\TextInput::make('sort_order')
                    ->label('Сортировка')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Показываем миниатюру
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение')
                    ->square(), // если хотите квадратную превью

                Tables\Columns\BadgeColumn::make('row')
                    ->label('Ряд')
                    // Меняем отображаемый текст в зависимости от значения
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'top' => 'Верхний',
                            'bottom' => 'Нижний',
                            default => $state,
                        };
                    })
                    // Можно дополнительно задать цвета для значений:
                    ->colors([
                        'warning' => 'top',
                        'success' => 'bottom',
                    ]),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Сортировка')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
