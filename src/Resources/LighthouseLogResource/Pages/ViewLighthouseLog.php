<?php

namespace Ngiraud\FilamentLighthouse\Resources\LighthouseLogResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Ngiraud\FilamentLighthouse\Resources\LighthouseLogResource;

class ViewLighthouseLog extends ViewRecord
{
    protected static string $resource = LighthouseLogResource::class;

    protected static string $view = 'filament-lighthouse-php::pages.view-record';
}
