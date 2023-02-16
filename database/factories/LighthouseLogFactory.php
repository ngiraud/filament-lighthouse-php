<?php

namespace Ngiraud\FilamentLighthouse\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ngiraud\FilamentLighthouse\Enums\Status;
use Ngiraud\FilamentLighthouse\Models\LighthouseLog;
use Spatie\Lighthouse\Enums\FormFactor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Ngiraud\FilamentLighthouse\Models\LighthouseLog>
 */
class LighthouseLogFactory extends Factory
{
    protected $model = LighthouseLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'device' => collect(FormFactor::cases())->random(),
            'status' => Status::Pending,
        ];
    }
}
