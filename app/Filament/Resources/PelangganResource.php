<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelangganResource\Pages;
use App\Models\Pelanggan;
use App\Models\TarifListrik;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pelanggan';

    protected static ?string $modelLabel = 'Pelanggan';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'pelanggan';

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama', 'no_hp', 'alamat', 'tarif_listrik.nama'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('no_hp')->label('No. HP')->required(),
                        Textarea::make('alamat')->required(),
                        Select::make('tarif_listrik_id')
                            ->label('Tarif Listrik')
                            ->options(TarifListrik::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("nama")->sortable()->searchable(),
                TextColumn::make("no_hp")->label('No. HP')->sortable()->searchable(),
                TextColumn::make("alamat")->sortable()->searchable(),
                TextColumn::make("tarif_listrik.nama")->label('Tarif Listrik')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);

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
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}
