<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TarifListrikResource\Pages;
use App\Models\TarifListrik;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TarifListrikResource extends Resource
{
    protected static ?string $model = TarifListrik::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Tarif Listrik';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $modelLabel = 'Tarif Listrik';
    
    protected static ?string $navigationGroup = 'Manajemen';
    
    protected static ?string $slug = 'tarif-listrik';

    public static function getGloballySearchableAttributes(): array
    {
        return ['kode', 'nama', 'daya', 'subsidi'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('kode')->required(),
                        TextInput::make('nama')->required(),
                        TextInput::make('daya')->numeric()->required(),
                        TextInput::make('harga')->numeric()->required(),
                        Toggle::make('subsidi'),
                        Hidden::make('user_id')->default(Auth::user()->id),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("kode")->sortable()->searchable(),
                TextColumn::make("nama")->sortable()->searchable(),
                TextColumn::make("daya")->sortable()->searchable()->formatStateUsing(function ($state) {
                    return number_format($state, 0, ',', '.') . " VA";
                }),
                TextColumn::make("subsidi")->sortable()->searchable()->formatStateUsing(function ($state) {
                    return ($state == 1) ? 'Ya' : 'Tidak';
                }),
                TextColumn::make("harga")->sortable()->searchable()->formatStateUsing(function ($state) {
                    return 'Rp ' . number_format($state, 0, ',', '.');
                }),
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
            'index' => Pages\ListTarifListriks::route('/'),
            'create' => Pages\CreateTarifListrik::route('/create'),
            'edit' => Pages\EditTarifListrik::route('/{record}/edit'),
        ];
    }
}