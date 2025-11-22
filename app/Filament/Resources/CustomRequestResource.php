<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomRequestResource\Pages;
use App\Filament\Resources\CustomRequestResource\RelationManagers;
use App\Models\CustomRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomRequestResource extends Resource
{
    protected static ?string $model = CustomRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'permintaan-khusus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\FileUpload::make('foto_referensi')
                    ->image()
                    ->nullable(),
                Forms\Components\Textarea::make('keterangan')
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'in_progress' => 'In Progress',
                        'done' => 'Done',
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\TextInput::make('harga_estimasi')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0.00),
                Forms\Components\TextInput::make('customer_name')
                    ->label('Nama Customer'),
                Forms\Components\TextInput::make('customer_email')
                    ->label('Email Customer')
                    ->email(),
                Forms\Components\TextInput::make('customer_phone')
                    ->label('Telepon Customer'),
                Forms\Components\TextInput::make('product_category')
                    ->label('Kategori Produk'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('foto_referensi')
                    ->getStateUsing(function ($record) {
                        if (!$record->foto_referensi) return null;
                        return asset($record->foto_referensi);
                    })
                    ->height(60)
                    ->width(60),
                Tables\Columns\TextColumn::make('keterangan')
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('harga_estimasi')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Customer'),
                Tables\Columns\TextColumn::make('customer_email')
                    ->label('Email Customer'),
                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('Telepon Customer'),
                Tables\Columns\TextColumn::make('product_category')
                    ->label('Kategori Produk'),
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
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'in_progress' => 'In Progress',
                        'done' => 'Done',
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
            'index' => Pages\ListCustomRequests::route('/'),
            'create' => Pages\CreateCustomRequest::route('/create'),
            'edit' => Pages\EditCustomRequest::route('/{record}/edit'),
        ];
    }
}
