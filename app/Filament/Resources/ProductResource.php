<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $slug = 'produk';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Manajemen Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'nama_kategori')
                    ->required(),
                Forms\Components\TextInput::make('nama_produk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->nullable(),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('products')
                    ->nullable(),
                Forms\Components\Select::make('tipe_produk')
                    ->options([
                        'ready' => 'Ready',
                        'custom' => 'Custom',
                    ])
                    ->required()
                    ->default('ready')
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state === 'custom') {
                            $set('harga', 0);
                        }
                    }),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->hidden(fn (Forms\Get $get) => $get('tipe_produk') === 'ready')
                    ->helperText('Harga untuk produk custom. Untuk produk ready stock, harga diatur per size di menu Varian Produk.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.nama_kategori')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('variants_count')
                    ->label('Jumlah Varian')
                    ->counts('variants')
                    ->badge()
                    ->color('success')
                    ->hidden(fn ($record) => $record && $record->tipe_produk === 'custom'),
                Tables\Columns\ImageColumn::make('foto')
                     ->getStateUsing(function ($record) {
                         if (!$record->foto) return null;
                         return asset('storage/' . $record->foto);
                     })
                     ->height(60)
                     ->width(60),
                Tables\Columns\TextColumn::make('tipe_produk')
                    ->badge(),
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
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'nama_kategori'),
                Tables\Filters\SelectFilter::make('tipe_produk')
                    ->options([
                        'ready' => 'Ready',
                        'custom' => 'Custom',
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
