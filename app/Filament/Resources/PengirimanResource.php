<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengirimanResource\Pages;
use App\Filament\Resources\PengirimanResource\RelationManagers;
use App\Models\Pengiriman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengirimanResource extends Resource
{
    protected static ?string $model = Pengiriman::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Pengiriman';
    protected static ?string $modelLabel = 'Pengiriman';
    protected static ?string $pluralModelLabel = 'Pengiriman';
    protected static ?string $slug = 'pengiriman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'id')
                    ->required(),
                Forms\Components\TextInput::make('nama_penerima')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat_pengiriman')
                    ->required(),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('kurir')
                    ->nullable(),
                Forms\Components\TextInput::make('no_resi')
                    ->nullable(),
                Forms\Components\Select::make('status_pengiriman')
                    ->options([
                        'pending' => 'Pending',
                        'dikirim' => 'Dikirim',
                        'sampai' => 'Sampai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\DatePicker::make('tanggal_kirim')
                    ->nullable(),
                Forms\Components\DatePicker::make('tanggal_terima')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.id')
                    ->label('Order ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat_pengiriman')
                    ->limit(50),
                Tables\Columns\TextColumn::make('no_hp'),
                Tables\Columns\TextColumn::make('kurir'),
                Tables\Columns\TextColumn::make('no_resi'),
                Tables\Columns\TextColumn::make('status_pengiriman')
                    ->badge(),
                Tables\Columns\TextColumn::make('tanggal_kirim')
                    ->date(),
                Tables\Columns\TextColumn::make('tanggal_terima')
                    ->date(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pengiriman')
                    ->options([
                        'pending' => 'Pending',
                        'dikirim' => 'Dikirim',
                        'sampai' => 'Sampai',
                        'dibatalkan' => 'Dibatalkan',
                    ]),
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
            'index' => Pages\ListPengiriman::route('/'),
            'create' => Pages\CreatePengiriman::route('/create'),
            'edit' => Pages\EditPengiriman::route('/{record}/edit'),
        ];
    }
}
