<?php

namespace Webkul\ProgressStepper\Enums;

enum ConnectorShape: string
{
    case Arrow = 'arrow';
    case Chevron = 'chevron';
    case Dot = 'dot';
    case Line = 'line';

    public static function default(): self
    {
        return self::Arrow;
    }
}
