<?php

namespace App\Filament\Resources\Almacens;

use App\Filament\Resources\Almacens\Pages\CreateAlmacen;
use App\Filament\Resources\Almacens\Pages\EditAlmacen;
use App\Filament\Resources\Almacens\Pages\ListAlmacens;
use App\Filament\Resources\Almacens\Pages\ViewAlmacen;
use App\Filament\Resources\Almacens\Schemas\AlmacenForm;
use App\Filament\Resources\Almacens\Schemas\AlmacenInfolist;
use App\Filament\Resources\Almacens\Tables\AlmacensTable;
use App\Models\Almacen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AlmacenResource extends Resource
{
    protected static ?string $model = Almacen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return AlmacenForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AlmacenInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlmacensTable::configure($table);
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
            'index' => ListAlmacens::route('/'),
            'create' => CreateAlmacen::route('/create'),
            'view' => ViewAlmacen::route('/{record}'),
            'edit' => EditAlmacen::route('/{record}/edit'),
        ];
    }
}
