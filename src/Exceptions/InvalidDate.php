<?php

namespace Spatie\Period\Exceptions;

use InvalidArgumentException;

class InvalidDate extends InvalidArgumentException
{
    public static function cannotBeNull($parameter)
    {
        return new static("{$parameter} cannot be null");
    }
    public static function forFormat($date, $format = null)
    {
        $message = "Could not construct a date from `{$date}`";

        if ($format) {
            $message .= " with format `{$format}`";
        }

        return new static($message);
    }
}
