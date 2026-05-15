<?php

namespace App\Filament\Resources\ProductoTerminados;

use App\Filament\Resources\ProductoTerminados\Pages\CreateProductoTerminado;
use App\Filament\Resources\ProductoTerminados\Pages\EditProductoTerminado;
use App\Filament\Resources\ProductoTerminados\Pages\ListProductoTerminados;
use App\Filament\Resources\ProductoTerminados\Pages\ViewProductoTerminado;
use App\Filament\Resources\ProductoTerminados\Schemas\ProductoTerminadoForm;
use App\Filament\Resources\ProductoTerminados\Schemas\ProductoTerminadoInfolist;
use App\Filament\Resources\ProductoTerminados\Tables\ProductoTerminadosTable;
use App\Models\ProductoTerminado;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductoTerminadoResource extends Resource
{
    protected static ?string $model = ProductoTerminado::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?string $label = 'Producto Terminado';
    protected static ?string $pluralModelLabel = 'Productos Terminados';

    public static function form(Schema $schema): Schema
    {
        return ProductoTerminadoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductoTerminadoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductoTerminadosTable::configure($table);
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
            'index' => ListProductoTerminados::route('/'),
            'create' => CreateProductoTerminado::route('/create'),
            'view' => ViewProductoTerminado::route('/{record}'),
            'edit' => EditProductoTerminado::route('/{record}/edit'),
        ];
    }
}
