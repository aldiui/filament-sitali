<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagihanResource\Pages;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TagihanResource extends Resource
{
    protected static ?string $model = Tagihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Tagihan';

    protected static ?string $recordTitleAttribute = 'bulan_tagihan';

    protected static ?string $modelLabel = 'Tagihan';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'tagihan';

    public static function getGloballySearchableAttributes(): array
    {
        return ['pemakaian', 'pelanggan.nama', 'total_tagihan'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('pemakaian')
                            ->numeric()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if ($get('pelanggan_id') !== null) {
                                    $set('total_tagihan', Pelanggan::find($get('pelanggan_id'))->tarif_listrik->harga * $state);
                                }
                            }),
                        Select::make('pelanggan_id')
                            ->label('Pelanggan')
                            ->options(Pelanggan::all()->pluck('nama', 'id')->toArray())
                            ->searchable()
                            ->required()
                            ->live(),
                        DatePicker::make('bulan_tagihan')
                            ->format('m/y')
                            ->displayFormat('m/y')
                            ->label('Bulan Tagihan')
                            ->required(),
                        TextInput::make('total_tagihan')
                            ->label('Total Tagihan')
                            ->numeric()
                            ->required()
                            ->readOnly()
                            ->live(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("bulan_tagihan")->label('Bulan Tagihan')->sortable()->searchable(),
                TextColumn::make("pelanggan.nama")->label('Pelanggan')->sortable()->searchable(),
                TextColumn::make("pemakaian")->sortable()->searchable()->formatStateUsing(function ($state) {
                    return number_format($state, 0, ',', '.') . " kwh";
                }),
                TextColumn::make("total_tagihan")->label('Total Tagihan')->sortable()->searchable()->formatStateUsing(function ($state) {
                    return 'Rp ' . number_format($state, 0, ',', '.');
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTagihans::route('/'),
            'create' => Pages\CreateTagihan::route('/create'),
            'edit' => Pages\EditTagihan::route('/{record}/edit'),
        ];
    }
}