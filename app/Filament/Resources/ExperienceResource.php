<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    
    protected static ?string $navigationGroup = 'Portfolio';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('position')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Forms\Components\TextInput::make('company')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(4)
                            ->columnSpan(2),
                        
                        Forms\Components\DatePicker::make('start_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('M Y'),
                        
                        Forms\Components\DatePicker::make('end_date')
                            ->label('End Date (Leave empty if current)')
                            ->native(false)
                            ->displayFormat('M Y'),
                        
                        Forms\Components\Textarea::make('technologies')
                            ->label('Technologies (comma separated)')
                            ->placeholder('PHP, Laravel, MySQL, JavaScript')
                            ->helperText('Separate technologies with commas')
                            ->rows(2)
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
                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->date('M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('end_date')
                    ->date('M Y')
                    ->placeholder('Present')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('technologies')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                Tables\Filters\Filter::make('current_job')
                    ->label('Current Job')
                    ->query(fn (Builder $query): Builder => $query->whereNull('end_date')),
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
            ->defaultSort('start_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}