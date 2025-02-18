<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'О проекте';
    protected static ?string $modelLabel = 'О проекте';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2) // Две колонки
                        ->schema([
                            // Левая колонка (фото)
                            FileUpload::make('project_manager_photo')
                                ->label('Фото руководителя')
                                ->directory('about')
                                ->image(),

                            // Правая колонка (имя и текст)
                            Grid::make(1) // Доп. грид, чтобы расположить поля друг под другом
                            ->schema([
                                TextInput::make('project_manager_name')
                                    ->label('Имя руководителя проекта')
                                    ->required()
                                    ->maxLength(255),

                                RichEditor::make('project_manager_text')
                                    ->label('Текст о руководителе')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                        'blockquote',
                                        'codeBlock',
                                    ]),
                            ]),
                        ]),
                    ])
                    ->columns(1), // Card в одну колонку, т.к. внутри уже свой Grid

                // Ниже — можно добавить оставшиеся поля для "Цели проекта" и т.д.
                Card::make()
                    ->schema([
                        FileUpload::make('project_goal_photo')
                            ->label('Фото для "Цель проекта"')
                            ->directory('about')
                            ->image(),
                        TextInput::make('project_goal_title')
                            ->label('Заголовок цели проекта')
                            ->maxLength(255),
                        RichEditor::make('project_goal_text')
                            ->label('Текст "Цель проекта"')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'link',
                                'blockquote',
                                'codeBlock',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_manager_name')
                    ->label('Руководитель')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('project_goal_title')
                    ->label('Заголовок цели')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
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
//                    Tables\Actions\DeleteBulkAction::make(),
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
            // Вместо ListAbouts («список») сразу EditAbout
            'index' => Pages\EditAbout::route('/'),
        ];
    }
}
