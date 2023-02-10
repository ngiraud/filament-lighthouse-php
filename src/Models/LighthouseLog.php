<?php

namespace Ngiraud\FilamentLighthouse\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ngiraud\FilamentLighthouse\Enums\Status;
use Spatie\Lighthouse\Enums\FormFactor;

class LighthouseLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'device' => FormFactor::class,
        'status' => Status::class,
    ];

    public function markAsFail()
    {
        $this->update(['status' => Status::Fail]);
    }

    public function markAsSuccess(array $data)
    {
        $this->update(array_merge($data, ['status' => Status::Success]));
    }

    protected function deviceForHumans(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => Str::ucfirst(__($attributes['device'])),
        );
    }
}
