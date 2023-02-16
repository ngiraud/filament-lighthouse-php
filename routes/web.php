<?php

use Illuminate\Support\Facades\Route;
use Ngiraud\FilamentLighthouse\Http\Controllers\LighthouseReportController;

Route::domain(config('filament.domain'))
     ->middleware(collect(config('filament.middleware'))->flatten()->toArray())
     ->prefix(config('filament.path'))->group(function () {
         Route::get('/lighthouse-log/{log}/report', LighthouseReportController::class)->name('filament-lighthouse-php.report');
     });
