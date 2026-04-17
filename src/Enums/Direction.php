<?php

namespace Webkul\ProgressStepper\Enums;

enum Direction: string
{
    case Horizontal = 'horizontal';
    case Vertical = 'vertical';

    public static function default(): self
    {
        return self::Horizontal;
    }
}
