<?php

namespace Ngiraud\FilamentLighthouse\Resources;

use Filament\Forms\Components\KeyValue;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Ngiraud\FilamentLighthouse\Enums\Status;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;
use Ngiraud\FilamentLighthouse\Resources\LighthouseLogResource\Pages;

class LighthouseLogResource extends Resource
{
    protected static ?string $model = LighthouseLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                KeyValue::make('audits'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                          ->label(__('filament-lighthouse-php::default.column.id'))
                          ->sortable(),

                TextColumn::make('device_for_humans')
                          ->label(__('filament-lighthouse-php::default.column.device'))
                          ->sortable(['device']),

                BadgeColumn::make('status')
                           ->label(__('filament-lighthouse-php::default.column.status'))
                           ->enum(Status::labels())
                           ->colors(Status::colors())
                           ->sortable(),

                TextColumn::make('generated_at')
                          ->label(__('filament-lighthouse-php::default.column.generation_date'))
                          ->date(__('filament-lighthouse-php::default.formatting.date')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hidden(fn(LighthouseLog $record) => !$record->isGenerated()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->poll('10s');
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
            'index' => Pages\ListLighthouseLogs::route('/'),
            'create' => Pages\CreateLighthouseLog::route('/create'),
            'view' => Pages\ViewLighthouseLog::route('/{record}'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('filament-lighthouse-php::default.resource.label.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-lighthouse-php::default.resource.label.plural');
    }

    protected static function getNavigationLabel(): string
    {
        return __('filament-lighthouse-php::default.nav.label');
    }

    protected static function getNavigationIcon(): string
    {
        return __('filament-lighthouse-php::default.nav.icon');
    }
}
