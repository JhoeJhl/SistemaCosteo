<?php
namespace App\Filament\Resources\Campanias\Pages;

//Filament
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\SelectFilter;

use App\Filament\Resources\Campanias\CampaniaResource;
use App\Filament\Resources\Campanias\Schemas\CostoVariableForm;
use App\Filament\Resources\Campanias\Widgets\CostosVariablesStats;

//Opciones de table
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

use BackedEnum;


class ManageCostosVariables extends ManageRelatedRecords
{
    protected static string $resource = CampaniaResource::class;
    protected static string $relationship = 'costosVariables';
     protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube-transparent';

    public function getTitle(): string
    {
        return 'Costos Variables: ' . $this->getOwnerRecord()->nombre;
    }

    public function getHeading(): string
    {
        return 'Administración de Costos Operativos';
    }

    public function getSubheading(): ?string
    {
        return 'Registros dependientes del volumen de producción.';
    }

    public function getBreadcrumb(): string
    {
        return 'Costos Variables';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CostosVariablesStats::class,
        ];
    }

    // Inyección de la API Schema moderna
    public function form(Schema $schema): Schema
    {
        return CostoVariableForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('descripcion')
            ->columns([
                TextColumn::make('fecha_registro')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('categoria')
                    ->label('Categoría')
                    ->badge()
                    ->searchable()
                    ->color(fn ($state) => match ($state) {
                        'Mano de Obra' => 'info',
                        'Procesamiento' => 'primary',
                        'Empaque' => 'success',
                        'Transporte' => 'warning',
                        'Energia Operativa' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(45)
                    ->searchable(),

                TextColumn::make('unidad_costo')
                    ->label('Unidad')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('monto')
                    ->label('Monto')
                    ->money('BOB')
                    ->weight(FontWeight::Bold)
                    ->sortable()
                    ->alignEnd(),
            ])
            ->filters([
                SelectFilter::make('categoria')
                    ->options([
                        'Mano de Obra' => 'Mano de Obra',
                        'Procesamiento' => 'Procesamiento',
                        'Empaque' => 'Empaque',
                        'Transporte' => 'Transporte',
                        'Energia Operativa' => 'Energía Operativa',
                    ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Registrar Gasto Operativo')
                    ->icon('heroicon-m-plus-circle')
                    ->slideOver() // Modal lateral elegante
                    ->successNotificationTitle('Gasto variable registrado exitosamente'),
            ])
            ->actions([
                EditAction::make()->slideOver(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('¿Eliminar registro de costo?')
                    ->modalDescription('Esta acción alterará el cálculo del costo unitario final. ¿Desea continuar?'),
            ])
            ->emptyStateHeading('Cero costos operativos registrados')
            ->emptyStateDescription('Comience a registrar la mano de obra y recursos utilizados en el procesamiento.')
            ->emptyStateIcon('heroicon-o-cube-transparent');
    }
}