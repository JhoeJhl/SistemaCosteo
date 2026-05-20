<?php

namespace App\Filament\Resources\Campanias;

use App\Filament\Resources\Campanias\Pages\CreateCampania;
use App\Filament\Resources\Campanias\Pages\EditCampania;
use App\Filament\Resources\Campanias\Pages\ListCampanias;
use App\Filament\Resources\Campanias\Pages\ViewCampania;
use App\Filament\Resources\Campanias\Schemas\CampaniaForm;
use App\Filament\Resources\Campanias\Schemas\CampaniaInfolist;
use App\Filament\Resources\Campanias\Tables\CampaniasTable;
use App\Models\Campania;
use BackedEnum;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CampaniaResource extends Resource
{
    protected static ?string $model = Campania::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $label = 'Campaña';
    protected static ?string $pluralModelLabel = 'Campañas';


    public static function form(Schema $schema): Schema
    {
        return CampaniaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CampaniaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CampaniasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CostoCampaniasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCampanias::route('/'),
            'create' => CreateCampania::route('/create'),
            'view' => ViewCampania::route('/{record}'),
            'edit' => EditCampania::route('/{record}/edit'),
        ];
    }
}
