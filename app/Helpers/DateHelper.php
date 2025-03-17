<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function datetime(?string $value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        return Carbon::parse($value)->timezone(config('app.timezone'))->toDateTimeString();
    }
}
