<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentResource\Pages;
use App\Filament\Resources\ComponentResource\RelationManagers;
use App\Models\Component;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponentResource extends Resource
{
    protected static ?string $model = Component::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Компоненты';
    protected static ?string $pluralModelLabel = 'Компоненты';
    protected static ?string $modelLabel = 'Компонент';
    protected static ?string $navigationGroup = 'Контент';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Системное имя (name)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->label('Заголовок (title)')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('img')
                    ->label('Изображение')
                    ->directory('components/img')
                    ->image(),
                Forms\Components\FileUpload::make('video')
                    ->label('Видео')
                    ->directory('components/video'),

                // Флаг is_general
                Forms\Components\Toggle::make('is_general')
                    ->label('General (доступен везде)?')
                    ->reactive()
                    ->helperText('Если включено, компонент будет отображаться «везде» и не привязан к конкретной странице.'),

                // Поле page_id (показываем только если is_general = false)
                Forms\Components\Select::make('page_id')
                    ->label('Страница')
                    ->relationship('page', 'title')
                    ->placeholder('Выберите страницу...')
                    ->hidden(fn($get) => $get('is_general') === true)
                    ->default(null)
                    ->reactive(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\IconColumn::make('is_general')
                    ->boolean()
                    ->label('General?'),
                Tables\Columns\TextColumn::make('page.title')
                    ->label('Страница')
                    ->default('—') // если null, будет «—»
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
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
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
