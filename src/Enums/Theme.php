<?php

namespace Webkul\ProgressStepper\Enums;

enum Theme: string
{
    case Filled = 'filled';
    case Outlined = 'outlined';
    case Minimal = 'minimal';

    public static function default(): self
    {
        return self::Filled;
    }
}
