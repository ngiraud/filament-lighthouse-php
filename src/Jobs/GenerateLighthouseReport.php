<?php

namespace Ngiraud\FilamentLighthouse\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;
use Spatie\Lighthouse\Lighthouse;

class GenerateLighthouseReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $chromeOptions = [
        'chromeFlags' => [
            '--headless',
            '--no-sandbox',
        ],
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public LighthouseLog $log)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $this->log->markAsSuccess(
                Lighthouse::url(config('app.url'))
                          ->withChromeOptions($this->chromeOptions)
                          ->formFactor($this->log->device)
                          ->run()
            );
        } catch (Exception $e) {
            $this->log->markAsFail();
        }
    }
}
