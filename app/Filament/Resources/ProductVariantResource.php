<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductVariantResource\Pages;
use App\Filament\Resources\ProductVariantResource\RelationManagers;
use App\Models\ProductVariant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Varian Produk';
    protected static ?string $modelLabel = 'Varian Produk';
    protected static ?string $pluralModelLabel = 'Varian Produk';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Manajemen Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'nama_produk')
                    ->required()
                    ->searchable()
                    ->helperText('Pilih produk ready stock yang akan diberi variant'),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: S, M, L, XL')
                    ->helperText('Ukuran produk (S, M, L, XL, dll)'),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Jumlah stok untuk ukuran ini'),
                Forms\Components\TextInput::make('price_adjustment')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp')
                    ->helperText('Harga untuk ukuran ini'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.nama_produk')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('size')
                    ->label('Ukuran')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->sortable()
                    ->color(fn (int $state): string => $state === 0 ? 'danger' : ($state < 5 ? 'warning' : 'success')),
                Tables\Columns\TextColumn::make('price_adjustment')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('product')
                    ->relationship('product', 'nama_produk')
                    ->label('Produk'),
                Tables\Filters\SelectFilter::make('size')
                    ->options([
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                    ])
                    ->label('Ukuran'),
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
            'index' => Pages\ListProductVariants::route('/'),
            'create' => Pages\CreateProductVariant::route('/create'),
            'edit' => Pages\EditProductVariant::route('/{record}/edit'),
        ];
    }
}
