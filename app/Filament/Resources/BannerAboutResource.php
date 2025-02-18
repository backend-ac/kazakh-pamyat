<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerAboutResource\Pages;
use App\Filament\Resources\BannerAboutResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerAboutResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationLabel = 'Баннер «О проекте»';
    protected static ?string $navigationGroup = 'Картинки';
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    // 1) Фильтруем только записи, у которых banner_type = 'about'
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('banner_type', 'about');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Поле для загрузки картинки
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->directory('banners')
                    ->image(),

                // Поле сортировки
                Forms\Components\TextInput::make('sort_order')
                    ->label('Сортировка')
                    ->numeric()
                    ->default(0),

                // Скрытое (или disabled) поле `banner_type`,
                // чтобы при создании/редактировании была только about
                Forms\Components\Hidden::make('banner_type')
                    ->default('about'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),

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
            'index' => Pages\ListBannerAbouts::route('/'),
            'create' => Pages\CreateBannerAbout::route('/create'),
            'edit' => Pages\EditBannerAbout::route('/{record}/edit'),
        ];
    }
}
