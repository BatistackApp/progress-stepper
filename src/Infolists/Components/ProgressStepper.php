<?php

namespace Webkul\ProgressStepper\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;
use Webkul\ProgressStepper\Concerns\HasProgressStepperStyle;

class ProgressStepper extends Entry
{
    use HasProgressStepperStyle;

    protected string $view = 'progress-stepper::infolists.progress-stepper';

    protected mixed $options = [];

    protected mixed $isInline = false;

    protected array | Closure $icons = [];

    public function options(array | Closure $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->evaluate($this->options) ?? [];
    }

    public function inline(bool | Closure $inline = true): static
    {
        $this->isInline = $inline;

        return $this;
    }

    public function isInline(): bool
    {
        return (bool) $this->evaluate($this->isInline);
    }

    public function icons(array | Closure $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    public function getStepIcon(string $value): ?string
    {
        $icons = $this->evaluate($this->icons) ?? [];

        return $icons[$value] ?? null;
    }

    public function getColor(string $value): string
    {
        return $this->getStepColor($value);
    }

    public function getVisibleOptions(): array
    {
        return $this->getResolvedOptions();
    }
}
