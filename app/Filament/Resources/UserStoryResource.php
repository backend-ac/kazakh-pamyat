<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserStoryResource\Pages;
use App\Filament\Resources\UserStoryResource\RelationManagers;
use App\Models\Participant;
use App\Models\UserStory;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserStoryResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Истории от пользователей';
    protected static ?string $pluralModelLabel = 'Истории от пользователей';
    protected static ?string $modelLabel = 'История';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'user_story');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sender_name')
                    ->label('ФИО отправителя')
                    ->maxLength(255)
                    ->disabled(), // Если хотите редактировать, уберите disabled()

                // Поле "name" (ФИО погибшего)
                TextInput::make('name')
                    ->label('ФИО погибшего')
                    ->maxLength(255)
                    ->required(),

                // user_message (сообщение)
                RichEditor::make('user_message')
                    ->label('Сообщение')
                    ->columnSpanFull()
                    ->disabled(false), // уберите, если нужно редактировать

                // Если вы хотите всё-таки хранить place_id
                // (или оно не обязательно), можете включить Select
                // и сделать nullable (или disabled):
                Select::make('place_id')
                    ->label('Привязать к месту (не обязательно)')
                    ->options(\App\Models\Place::all()->pluck('title', 'id'))
                    ->searchable()
                    ->nullable(), // если place_id может быть null
                Checkbox::make('make_official')
                    ->label('Сделать официальным участником (перенести из "историй")?')
                    // Подсказка или описание
                    ->helperText('Если отметить, запись перестанет быть "user_story" и станет "official".'),
                // Дата рождения, дата смерти, где воевал:
                TextInput::make('date_of_birth')
                    ->label('Дата рождения')
                    ->maxLength(255),
                TextInput::make('date_of_death')
                    ->label('Дата смерти')
                    ->maxLength(255),
                TextInput::make('where_did_participate')
                    ->label('Где воевал')
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->label('Фото')
                    ->directory('participants')
                    ->image(),

                RichEditor::make('bio')
                    ->label('Биография')
                    ->columnSpanFull(),

                // Repeater для доп. блоков (infos), если нужно:
                Repeater::make('infos')
                    ->label('Доп. информация')
                    ->relationship()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Group::make()
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Картинка')
                                            ->directory('participant_infos')
                                            ->image(),
                                        TextInput::make('image_description')
                                            ->label('Подпись к картинке')
                                            ->maxLength(255),
                                    ]),
                                Forms\Components\Group::make()
                                    ->schema([
                                        TextInput::make('order')
                                            ->label('Порядок')
                                            ->numeric()
                                            ->default(0),
                                        RichEditor::make('text')
                                            ->label('Текст')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'underline', 'strike',
                                                'bulletList', 'orderedList', 'link',
                                                'blockquote', 'codeBlock',
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->orderable('order')
                    ->collapsible()
                    ->createItemButtonLabel('Добавить блок'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Можно вывести фото
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Фото')
                    ->square(),

                Tables\Columns\TextColumn::make('sender_name')
                    ->label('Отправитель')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('ФИО погибшего')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('Год рождения')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_of_death')
                    ->label('Год смерти')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
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
            'index' => Pages\ListUserStories::route('/'),
            'create' => Pages\CreateUserStory::route('/create'),
            'edit' => Pages\EditUserStory::route('/{record}/edit'),
        ];
    }
}
