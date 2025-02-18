<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Filament\Resources\ParticipantResource\RelationManagers;
use App\Models\Participant;
use App\Models\Place;
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

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Участники войны';
    protected static ?string $pluralModelLabel = 'Участники войны';
    protected static ?string $modelLabel = 'Участник';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', '!=', 'user_story')
            // или вариант: ->whereNull('type')->orWhere('type','!=','user_story')
            ;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Выбираем место (place)
                Select::make('place_id')
                    ->label('Место')
                    ->options(Place::all()->pluck('title', 'id'))
                    ->searchable()
                    ->nullable(),

                TextInput::make('name')
                    ->label('ФИО')
                    ->maxLength(255)
                    ->required(),

                TextInput::make('date_of_birth')
                    ->label('Дата рождения')
                    ->maxLength(255),

                TextInput::make('date_of_death')
                    ->label('Причина выбытия')
                    ->maxLength(255),

//                TextInput::make('where_did_participate')
//                    ->label('Где воевал')
//                    ->maxLength(255),
                Checkbox::make('show_on_gs')
                    ->label('Показать на ГС'),
                FileUpload::make('photo')
                    ->label('Фото участника')
                    ->directory('participants') // папка в storage/app/public/participants
                    ->image(),
//                Forms\Components\RichEditor::make('bio')
//                    ->label('Биография')
//                    ->columnSpanFull(),

                Repeater::make('infos')
                    ->label('Доп. информация')
                    ->relationship() // связь hasMany("infos") в модели Participant
                        ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                // Левая колонка: картинка + описание
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

                                // Правая колонка: порядок + текст
                                Forms\Components\Group::make()
                                    ->schema([
                                        TextInput::make('order')
                                            ->label('Порядок')
                                            ->numeric()
                                            ->default(0),
                                        Forms\Components\RichEditor::make('text')
                                            ->label('Текст')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'underline', 'strike',
                                                'bulletList', 'orderedList', 'link',
                                                'blockquote', 'codeBlock',
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->orderable('order')    // Позволяет перетаскивать элементы, отражая новый порядок в поле "order"
                    ->collapsible()         // Сделать каждый блок сворачиваемым/разворачиваемым
                    ->createItemButtonLabel('Добавить блок информации')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Можно вывести мини-аватар
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Фото')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->label('ФИО')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('place.title')
                    ->label('Место')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('Год рождения')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_of_death')
                    ->label('Год смерти')
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
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
