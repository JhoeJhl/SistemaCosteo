<?php

namespace App\Filament\Resources\EntradaMercancias;

use App\Filament\Resources\EntradaMercancias\Pages\CreateEntradaMercancia;
use App\Filament\Resources\EntradaMercancias\Pages\EditEntradaMercancia;
use App\Filament\Resources\EntradaMercancias\Pages\ListEntradaMercancias;
use App\Models\EntradaMercancia;

use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

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
        return $schema
            ->components([
                Grid::make(12)
                    ->schema([

                        Select::make('campana_id')
                            ->relationship('campana', 'nombre')
                            ->label('Campaña')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-flag')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 3,
                            ]),

                        Select::make('almacen_id')
                            ->relationship('almacen', 'nombre')
                            ->label('Almacén')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-building-office-2')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 3,
                            ]),

                        Select::make('proveedor_id')
                            ->relationship('proveedor', 'nombre')
                            ->label('Proveedor')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-building-storefront')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 3,
                            ]),

                        DatePicker::make('fecha_ingreso')
                            ->label('Fecha Ingreso')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->prefixIcon('heroicon-m-calendar-days')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 3,
                            ]),

                        Select::make('producto_id')
                            ->relationship('producto', 'nombre')
                            ->label('Producto')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-m-cube')
                            ->columnSpan([
                                'default' => 12,
                                'md' => 4,
                            ]),

                        Select::make('unidad_medida')
                            ->label('Unidad')
                            ->required()
                            ->native(false)
                            ->options([
                                'kg' => 'Kilogramos',
                                'unidades' => 'Unidades',
                                'bolsas' => 'Bolsas',
                                'cajas' => 'Cajas',
                                'litros' => 'Litros',
                            ])
                            ->columnSpan([
                                'default' => 12,
                                'md' => 2,
                            ]),

                        TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->required()
                            ->numeric()
                            ->minValue(0.01)
                            ->live(debounce: 500)
                            ->prefixIcon('heroicon-m-arrows-up-down')
                            ->afterStateUpdated(
                                fn (Get $get, Set $set) => self::calcularTotal($get, $set)
                            )
                            ->columnSpan([
                                'default' => 12,
                                'md' => 2,
                            ]),

                        TextInput::make('costo_unitario')
                            ->label('Costo Unitario')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Bs.')
                            ->live(debounce: 500)
                            ->afterStateUpdated(
                                fn (Get $get, Set $set) => self::calcularTotal($get, $set)
                            )
                            ->columnSpan([
                                'default' => 12,
                                'md' => 2,
                            ]),

                        TextInput::make('costo_total')
                            ->label('Costo Total')
                            ->numeric()
                            ->readOnly()
                            ->dehydrated()
                            ->prefix('Bs.')
                            ->extraInputAttributes([
                                'class' => 'font-semibold',
                            ])
                            ->columnSpan([
                                'default' => 12,
                                'md' => 2,
                            ]),

                        TextInput::make('observaciones')
                            ->label('Observaciones')
                            ->placeholder('Detalles adicionales...')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ]);
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
                    ->suffix(fn ($record) => ' ' . $record->unidad_medida),

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

    private static function calcularTotal(Get $get, Set $set): void
    {
        $cantidad = (float) ($get('cantidad') ?? 0);

        $costoUnitario = (float) ($get('costo_unitario') ?? 0);

        $set(
            'costo_total',
            number_format($cantidad * $costoUnitario, 2, '.', '')
        );
    }
}