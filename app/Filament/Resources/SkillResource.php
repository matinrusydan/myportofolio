<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('description')
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpan(2),

                        Forms\Components\Select::make('level')
                            ->label('Skill Level (%)')
                            ->options([
                                10 => '10%',
                                20 => '20%',
                                30 => '30%',
                                40 => '40%',
                                50 => '50%',
                                60 => '60%',
                                70 => '70%',
                                80 => '80%',
                                90 => '90%',
                                95 => '95%',
                                100 => '100%'
                            ])
                            ->default(70)
                            ->required(),

                        Forms\Components\FileUpload::make('icon')
                            ->label('Icon')
                            ->image()
                            ->directory('skills')
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(2048),

                        Forms\Components\TextInput::make('order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->square()
                    ->size(40),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('level')
                    ->label('Level')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}