<?php

namespace App\Filament\Resources\Proveedores;

use App\Filament\Resources\Proveedores\Pages\CreateProveedores;
use App\Filament\Resources\Proveedores\Pages\EditProveedores;
use App\Filament\Resources\Proveedores\Pages\ListProveedores;
use App\Filament\Resources\Proveedores\Pages\ViewProveedores;
use App\Filament\Resources\Proveedores\Schemas\ProveedoresForm;
use App\Filament\Resources\Proveedores\Schemas\ProveedoresInfolist;
use App\Filament\Resources\Proveedores\Tables\ProveedoresTable;
use App\Models\Proveedores;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProveedoresResource extends Resource
{
    protected static ?string $model = Proveedores::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return ProveedoresForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProveedoresInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProveedoresTable::configure($table);
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
            'index' => ListProveedores::route('/'),
            'create' => CreateProveedores::route('/create'),
            'view' => ViewProveedores::route('/{record}'),
            'edit' => EditProveedores::route('/{record}/edit'),
        ];
    }
}
