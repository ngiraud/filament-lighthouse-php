<?php

namespace Ngiraud\FilamentLighthouse\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ngiraud\FilamentLighthouse\Enums\Status;
use Spatie\Lighthouse\Enums\FormFactor;
use Spatie\Lighthouse\LighthouseResult;

class LighthouseLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'device' => FormFactor::class,
        'status' => Status::class,
        'generated_at' => 'datetime',
    ];

    public function markAsFail()
    {
        $this->update(['status' => Status::Fail, 'generated_at' => null]);
    }

    public function markAsSuccess(LighthouseResult $result)
    {
        $this->update([
            'status' => Status::Success,
            'report' => $result->rawResults(),
            'generated_at' => now(),
        ]);
    }

    public function isGenerated(): bool
    {
        return $this->status === Status::Success && !is_null($this->generated_at);
    }

    protected function deviceForHumans(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => Str::ucfirst(__($attributes['device'])),
        );
    }

    public function getLighthouseResult(): ?LighthouseResult
    {
        if ($this->status !== Status::Success) {
            return null;
        }

        return new LighthouseResult(json_decode($this->report ?? [], true));
    }
}
