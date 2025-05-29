<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    
    protected static ?string $navigationGroup = 'Portfolio';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Forms\Components\TextInput::make('issuer')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Forms\Components\Textarea::make('description')
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpan(2),
                        
                        Forms\Components\DatePicker::make('date')
                            ->required()
                            ->native(false)
                            ->displayFormat('Y'),
                        
                        Forms\Components\TextInput::make('url')
                            ->label('Certificate/Credential URL')
                            ->url()
                            ->maxLength(255),
                        
                        Forms\Components\FileUpload::make('icon')
                            ->label('Icon/Badge')
                            ->image()
                            ->directory('achievements')
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(2048)
                            ->columnSpan(2),
                        
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
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('issuer')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('date')
                    ->date('Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab(),
                
                Tables\Columns\TextColumn::make('order')
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
                Tables\Filters\Filter::make('recent')
                    ->label('Recent (Last 3 Years)')
                    ->query(fn (Builder $query): Builder => $query->where('date', '>=', now()->subYears(3))),
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
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}