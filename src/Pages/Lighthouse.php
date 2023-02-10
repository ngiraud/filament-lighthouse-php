<?php

namespace Ngiraud\FilamentLighthouse\Pages;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ngiraud\FilamentLighthouse\Enums\Status;
use Ngiraud\FilamentLighthouse\Jobs\GenerateLighthouseReport;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;
use Spatie\Lighthouse\Enums\FormFactor;

class Lighthouse extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-lighthouse-php::pages.lighthouse';

    public ?LighthouseLog $record = null;

    protected $listeners = ['modal-closed' => 'closeModal'];

    protected function getActions(): array
    {
        return [
            Action::make('generate')
                  ->label(__('Generate'))
                  ->action('generate')
                  ->form([
                      Select::make('device')
                            ->label(__('Device'))
                            ->options(collect(FormFactor::cases())->mapWithKeys(
                                fn($item) => [$item->value => Str::ucfirst(__($item->label()))])
                            )
                            ->required(),
                  ]),
        ];
    }

    public function generate(array $data): void
    {
        GenerateLighthouseReport::dispatch(
            LighthouseLog::create([
                'device' => $data['device'],
                'status' => Status::Pending,
            ])
        );
    }

    protected function getTableQuery(): Builder
    {
        return LighthouseLog::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label(__('ID'))->sortable(),

            TextColumn::make('device_for_humans')->label(__('Device'))->sortable(['device']),

            BadgeColumn::make('status')->translateLabel()
                       ->enum(Status::labels())
                       ->colors(Status::colors())
                       ->sortable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('display-report')
                                 ->translateLabel()
                                 ->action('openReportModal')
                                 ->url(fn(LighthouseLog $record) => route('filament-lighthouse-php.report', $record))
                                 ->openUrlInNewTab(),
        ];
    }

    public function isTableRecordSelectable(): ?Closure
    {
        return fn(Model $record): bool => false;
    }

    protected function getTablePollingInterval(): ?string
    {
        return '10s';
    }
}
