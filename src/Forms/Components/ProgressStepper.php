<?php

namespace Webkul\ProgressStepper\Forms\Components;

use Filament\Forms\Components\ToggleButtons;
use Webkul\ProgressStepper\Concerns\HasProgressStepperStyle;

class ProgressStepper extends ToggleButtons
{
    use HasProgressStepperStyle;

    protected string $view = 'progress-stepper::forms.progress-stepper';

    public function getVisibleOptions(): array
    {
        return $this->getResolvedOptions();
    }
}
