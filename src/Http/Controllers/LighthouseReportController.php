<?php

namespace Ngiraud\FilamentLighthouse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;

class LighthouseReportController extends BaseController
{
    public function __invoke(Request $request, LighthouseLog $log)
    {
        return view('filament-lighthouse-php::report', compact('log'));
    }
}
