<?php

namespace Ngiraud\FilamentLighthouse\Resources\LighthouseLogResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;
use Ngiraud\FilamentLighthouse\Enums\Status;
use Ngiraud\FilamentLighthouse\Jobs\GenerateLighthouseReport;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;
use Ngiraud\FilamentLighthouse\Resources\LighthouseLogResource;
use Spatie\Lighthouse\Enums\FormFactor;

class ListLighthouseLogs extends ListRecords
{
    protected static string $resource = LighthouseLogResource::class;

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
                                fn ($item) => [$item->value => Str::ucfirst(__($item->label()))])
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
}
