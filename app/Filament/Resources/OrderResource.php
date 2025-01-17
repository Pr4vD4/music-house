<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Заказы';
    
    protected static ?string $modelLabel = 'Заказ';
    
    protected static ?string $pluralModelLabel = 'Заказы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->label('Статус')
                    ->options([
                        'new' => 'Новый',
                        'processing' => 'В обработке',
                        'completed' => 'Выполнен',
                        'cancelled' => 'Отменён',
                    ])
                    ->required(),
                    
                TextInput::make('total_amount')
                    ->label('Сумма заказа')
                    ->disabled()
                    ->numeric(),
                    
                Textarea::make('rejection_reason')
                    ->label('Причина отмены')
                    ->visible(fn ($get) => $get('status') === 'cancelled'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('№')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                    
                TextColumn::make('user.name')
                    ->label('Покупатель')
                    ->searchable(),
                    
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'processing' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'new' => 'Новый',
                        'processing' => 'В обработке',
                        'completed' => 'Выполнен',
                        'cancelled' => 'Отменён',
                        default => $state,
                    }),
                    
                TextColumn::make('total_amount')
                    ->label('Сумма')
                    ->money('rub')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        'new' => 'Новый',
                        'processing' => 'В обработке',
                        'completed' => 'Выполнен',
                        'cancelled' => 'Отменён',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}
