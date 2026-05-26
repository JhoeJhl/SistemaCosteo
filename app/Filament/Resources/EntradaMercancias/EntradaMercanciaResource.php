<?php

namespace App\Filament\Resources\EntradaMercancias;

use App\Filament\Resources\EntradaMercancias\Pages\CreateEntradaMercancia;
use App\Filament\Resources\EntradaMercancias\Pages\EditEntradaMercancia;
use App\Filament\Resources\EntradaMercancias\Pages\ListEntradaMercancias;
use App\Filament\Resources\EntradaMercancias\Schemas\EntradaMercanciaForm;
use App\Models\EntradaMercancia;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

// librerias de acciones
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;

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
        return $table
            ->recordUrl(null)
            ->recordAction(null)

            ->columns([

                TextColumn::make('fecha_ingreso')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('producto.nombre')
                    ->label('Producto')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('proveedor.nombre')
                    ->label('Proveedor')
                    ->searchable()
                    ->limit(20),

                TextColumn::make('cantidad')
                    ->label('Cantidad')
                    ->numeric(2)
                    ->badge()
                    ->color('info')
                    ->suffix(fn($record) => ' ' . $record->unidad_medida),

                TextColumn::make('costo_unitario')
                    ->label('Costo Unitario')
                    ->money('BOB', true)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('costo_total')
                    ->label('Costo Total')
                    ->money('BOB', true)
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

            ])

            ->filters([

                SelectFilter::make('campana_id')
                    ->relationship('campana', 'nombre')
                    ->label('Campaña'),

                SelectFilter::make('almacen_id')
                    ->relationship('almacen', 'nombre')
                    ->label('Almacén'),

            ])

            ->actions([

                EditAction::make(),

                DeleteAction::make(),

            ])

            ->bulkActions([

                BulkActionGroup::make([

                    // Vacío por seguridad

                ]),

            ]);
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
