<?php

namespace Webkul\ProgressStepper\Enums;

enum Size: string
{
    case Small = 'sm';
    case Medium = 'md';
    case Large = 'lg';

    public static function default(): self
    {
        return self::Medium;
    }
}
