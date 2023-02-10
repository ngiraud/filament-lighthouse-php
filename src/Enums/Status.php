<?php

namespace Ngiraud\FilamentLighthouse\Enums;

use Illuminate\Support\Collection;

enum Status: int
{
    case Pending = 1;
    case Success = 2;
    case Fail = 3;

    public static function labels(): Collection
    {
        return collect(self::cases())->mapWithKeys(function (self $status) {
            return [$status->value => __($status->name)];
        });
    }

    public static function colors(): array
    {
        return [
            'primary' => self::Pending->value,
            'success' => self::Success->value,
            'danger' => self::Fail->value,
        ];
    }
}
