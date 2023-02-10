<?php

namespace Ngiraud\FilamentLighthouse;

use Filament\PluginServiceProvider;
use Ngiraud\FilamentLighthouse\Pages\Lighthouse;
use Spatie\LaravelPackageTools\Package;

class FilamentLighthouseServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-lighthouse-php';

    protected array $resources = [
        // CustomResource::class,
    ];

    protected array $pages = [
        Lighthouse::class,
    ];

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
//        'plugin-filament-lighthouse-php' => __DIR__ . '/../resources/dist/filament-lighthouse-php.css',
    ];

    protected array $scripts = [
//        'plugin-filament-lighthouse-php' => __DIR__ . '/../resources/dist/filament-lighthouse-php.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-lighthouse-php' => __DIR__ . '/../resources/dist/filament-lighthouse-php.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
                ->hasViews()
                ->hasRoute('web')
                ->hasMigration('create_lighthouse_logs_table')
                ->runsMigrations();
    }
}
