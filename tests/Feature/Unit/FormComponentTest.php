<?php

use Filament\Forms\Components\ToggleButtons;
use Webkul\ProgressStepper\Forms\Components\ProgressStepper;

it('can be instantiated via make()', function () {
    expect(ProgressStepper::make('state'))->toBeInstanceOf(ProgressStepper::class);
});

it('extends Filament ToggleButtons', function () {
    expect(ProgressStepper::make('state'))->toBeInstanceOf(ToggleButtons::class);
});

it('uses the expected form view path', function () {
    $component = ProgressStepper::make('state');

    $reflection = new ReflectionProperty($component, 'view');
    $reflection->setAccessible(true);

    expect($reflection->getValue($component))->toBe('progress-stepper::forms.progress-stepper');
});

it('exposes getVisibleOptions matching the configured options when nothing is hidden', function () {
    $component = ProgressStepper::make('state')->options([
        'draft' => 'Draft',
        'sent' => 'Sent',
    ]);

    expect($component->getVisibleOptions())->toBe([
        'draft' => 'Draft',
        'sent' => 'Sent',
    ]);
});

it('filters out hidden states from getVisibleOptions', function () {
    $component = ProgressStepper::make('state')
        ->options([
            'draft' => 'Draft',
            'sent' => 'Sent',
            'cancelled' => 'Cancelled',
        ])
        ->hideStatesFor(fn () => ['cancelled']);

    expect($component->getVisibleOptions())->toBe([
        'draft' => 'Draft',
        'sent' => 'Sent',
    ]);
});

it('returns static from every stepper-specific setter for chaining', function () {
    $component = ProgressStepper::make('state');

    expect($component->size('lg'))->toBe($component);
    expect($component->direction('vertical'))->toBe($component);
    expect($component->theme('outlined'))->toBe($component);
    expect($component->connectorShape('chevron'))->toBe($component);
    expect($component->showIndex())->toBe($component);
    expect($component->iconOnly())->toBe($component);
    expect($component->markCompletedUpToCurrent())->toBe($component);
    expect($component->errorStates(['x']))->toBe($component);
    expect($component->stepDescription(['x' => 'X']))->toBe($component);
    expect($component->stepTooltip(['x' => 'X']))->toBe($component);
    expect($component->stepBadge(['x' => 1]))->toBe($component);
});
