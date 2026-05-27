<?php

namespace App\Filament\Resources\EntradaMercancias;

use App\Filament\Resources\EntradaMercancias\Pages\CreateEntradaMercancia;
use App\Filament\Resources\EntradaMercancias\Pages\EditEntradaMercancia;
use App\Filament\Resources\EntradaMercancias\Pages\ListEntradaMercancias;
use App\Filament\Resources\EntradaMercancias\Schemas\EntradaMercanciaForm;
use App\Filament\Resources\EntradaMercancias\Tables\EntradaMercanciasTable;
use App\Models\EntradaMercancia;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

use BackedEnum;

class EntradaMercanciaResource extends Resource
{
    protected static ?string $model = EntradaMercancia::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    protected static ?string $navigationLabel = 'Entrada Mercancía';

    protected static ?string $modelLabel = 'Ingreso de Mercancía';

    protected static ?string $pluralModelLabel = 'Ingresos de Mercancía';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return EntradaMercanciaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EntradaMercanciasTable::configure($table);

    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEntradaMercancias::route('/'),
            'create' => CreateEntradaMercancia::route('/create'),
            'edit' => EditEntradaMercancia::route('/{record}/edit'),
        ];
    }


}
