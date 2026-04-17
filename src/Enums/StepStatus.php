<?php

namespace Webkul\ProgressStepper\Enums;

enum StepStatus: string
{
    case Completed = 'completed';
    case Current = 'current';
    case Upcoming = 'upcoming';
    case Error = 'error';
}
